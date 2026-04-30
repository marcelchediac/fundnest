<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\CampaignDocument;
use Illuminate\Support\Facades\Http;


class CampaignController extends Controller
{
    public function create(){
        $categories = Category::all();
        return view('campaigns.create',compact('categories'));
    }

    public function store(Request $request) {
        $fields=$request->validate([
        'title'=>'required|string|max:255',
        'description'=>'required',
        'category_id' => 'required','other',
        'image'=>'nullable|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        'video_url'=>'nullable|url',
        'new_category' => 'nullable|string|max:255',
        'goal_amount' => 'required|numeric|min:500',
        'documents' => 'nullable',
         'documents.*' => 'mimes:pdf,jpg,jpeg,png|max:4096',
        
], [
    'goal_amount.min' => 'The campaign goal must be at least $500.',
]);


    $categoryId = null;

    if ($request->category_id === 'other') {
        if ($request->new_category) {
            $category = Category::firstOrCreate(['name' => $request->new_category]);
            $categoryId = $category->id;
        } else {
            return back()->with('error', 'Please enter a category name.');
        }
    } else {
        $categoryId = $request->category_id;
    }

       $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaigns', 'public');
             $fields['image'] = $imagePath;
        }

        $campaign=Campaign::create([
        'user_id' => auth()->id(),   
        'category_id' => $categoryId,
        'title' => $fields['title'],
        'description' => $fields['description'],
        'goal_amount' => $fields['goal_amount'],
        'collected_amount' => 0,
        'status' => 'pending',
        'image' => $imagePath,
        'video_url'=>$fields['video_url'],
        ]);

        $documentPaths = [];

        if ($request->hasFile('documents')) {
    foreach ($request->file('documents') as $file) {
        $path = $file->store('documents', 'public');
        CampaignDocument::create([
            'campaign_id' => $campaign->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
        ]);
        $documentPaths[] = $path;
    }
}
        $this->analyzeCampaign($campaign);

        return redirect()->back()->with("success", "campaign submitted successfully, waiting for approval");
    }

  public function analyzeCampaign($campaign)
{

   $documentCount = CampaignDocument::where('campaign_id', $campaign->id)->count();
   $documentStatus = $documentCount > 0
    ? "{$documentCount} documents uploaded"
    : "No documents uploaded";
    $prompt = "Analyze this donation campaign and respond ONLY with valid JSON like this:

{
  \"summary\": \"Short summary max 25 words\",
  \"risk\": \"low, medium, high\",
  \"recommendation\": \"Max 10 words\"
}

Risk rules:
- High risk if no document is uploaded.
- Medium risk if documents are uploaded but the description is unclear, too short, or lack details.
- Medium risk if the documents are uploaded but the goal amount is unusually high compared to the campaign description.
- Low risk if documents are uploaded , the description is clear and detailed, and the goal amount is reasonable.

Recommendation Rules:
- If no document is uploaded → recommendation MUST be Request document upload.
- If document exists → recommendation Must be review document before approval.

Campaign Details:
Title: {$campaign->title}
Description: {$campaign->description}
Goal Amount: {$campaign->goal_amount}
Document Status: {$documentStatus}

IMPORTANT: Do not write anything outside the JSON object. The output must be valid JSON.";


    $response = Http::withHeaders([
        'Authorization' => 'Bearer '.env('GROQ_API_KEY'),
    ])->post('https://api.groq.com/openai/v1/chat/completions', [
        'model' => 'llama-3.3-70b-versatile',
        'messages' => [
            [
                'role' => 'user',
                'content' => $prompt
            ]
        ]
    ]);


    $data = $response->json();
    \Log::info('AI Raw Response:', $data);

    $aiText = $data['choices'][0]['message']['content'] ?? null;
    \Log::info('AI Raw Text:', ['text' => $aiText]);

    
    $aiText = trim($aiText, " \n\r\t\"'");

    $aiJson = json_decode($aiText, true);


    if (!$aiJson) {
        \Log::error('AI JSON parse failed', ['text' => $aiText]);
        $aiJson = [
            'summary' => 'No summary provided',
            'risk' => 'medium',
            'recommendation' => 'Manual review required'
        ];
    }


    $campaign->update([
        'ai_summary' => $aiJson['summary'] ?? 'No summary provided',
        'ai_risk' => strtolower($campaign->calculateRiskLevel()),
        'ai_recommendation' => $aiJson['recommendation'] ?? 'Manual review required'
    ]);

    \Log::info('AI Parsed:', [
        'summary' => $campaign->ai_summary,
        'risk' => $campaign->ai_risk,
        'recommendation' => $campaign->ai_recommendation
    ]);
}


   public function show($id)
{
    $campaign = Campaign::with('comments.user')->findOrFail($id);
    return view('campaigns.show', compact('campaign'));
}

    public function comment(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string|max:500',
    ]);

    $campaign = Campaign::findOrFail($id);

    $campaign->comments()->create([
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);

    return redirect()->route('campaign.show', $id)->with('success', 'Comment added successfully!');
}
}
