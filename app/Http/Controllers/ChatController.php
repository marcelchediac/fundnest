<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
     $userMessage = $request->message;
     $cacheKey = 'chatbot_' . md5($userMessage);

      if (Cache::has($cacheKey)) {
            $reply = Cache::get($cacheKey);
            return response()->json(['reply' => $reply, 'cached' => true]);
        }

        $websiteContext = [
            'site_name' => 'FundNest',
            'description' => 'FundNest is a crowdfunding platform that allows users to create, donate, and manage campaigns.',
            'contact' => [
                'emails' => ['chediacmarcel@gmail.com', 'jzaouk@gmail.com'],
                'phones' => ['+96179322130', '+96171801560'],
                'location' => 'Lebanon'
            ],
            'services' => [
                'Education crowdfunding',
                'Medical crowdfunding',
                'Community projects crowdfunding'
            ],'faq' => [
                [
                    'question' => 'How can I create a campaign?',
                    'answer' => 'Click "Create Campaign" on the dashboard, fill out the form, and submit for review.'
                ],
                [
                    'question' => 'How do I donate to a campaign?',
                    'answer' => 'Go to the home page and click "Donate", then follow the payment instructions.'
                ],
                [
                    'question' => 'How fast does FundNest respond?',
                    'answer' => 'Our support team usually responds within 24 hours.'
                ],
                [
                    'question'=> 'Is there any specific amount to create a case?',
                    'answer'=> ' to Create a case Minimum amount is 500$.'
                ],
                [
                    'question'=>"Can i donate for my own case?",
                    "answer"=>"Absolutly not , also the donate button will be disabled"
                ],
                [
                    'question'=>'Can the donation be as unknown?',
                    'answer'=>"When you donate click on anonymous label, so no one can know your real name "
                ],
                [
                    'question'=>'when i create the campaign should i fill the form with video and photo?',
                    'answer'=>"if you want your case to be verify and done quickly you should at least put a photo or a video"
                ],
                [
                    'question'=>'Can I create several cases?',
                    "answer"=>"of course but make sure that this cases will take some time to be verify and can be rejected"

                ]
            ]
        ];

        $systemMessage = "You are a helpful assistant for FundNest. Use the following information to answer questions accurately:\n\n";

        $systemMessage .= "Site: " . $websiteContext['site_name'] . "\n";
        $systemMessage .= "Description: " . $websiteContext['description'] . "\n\n";

        $systemMessage .= "Contact:\n";
        foreach ($websiteContext['contact'] as $key => $value) {
            $systemMessage .= ucfirst($key) . ": " . (is_array($value) ? implode(', ', $value) : $value) . "\n";
        }

        $systemMessage .= "\nServices:\n- " . implode("\n- ", $websiteContext['services']) . "\n\n";

        $systemMessage .= "FAQs:\n";
        foreach ($websiteContext['faq'] as $faq) {
            $systemMessage .= "Q: {$faq['question']}\nA: {$faq['answer']}\n";
        }


        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'max_tokens' => 249,
                'temperature'=> 0.3,
            ]);

             \Log::info('Groq response: ' . $response->body());

           $reply = $response->json('choices')[0]['message']['content'] ?? 'Sorry, I could not get a response.';
            Cache::put($cacheKey, $reply, now()->addMinutes(60));

            return response()->json(['reply' => $reply]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['reply' => 'Error contacting OpenAI API'], 500);
        }
    }
}