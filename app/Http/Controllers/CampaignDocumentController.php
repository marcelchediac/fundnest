<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\CampaignDocument;

class CampaignDocumentController extends Controller
{
    public function create (Campaign $campaign){
       
        return view('campaigns.upload',compact('campaign'));
    }


    public function store(Request $request, Campaign $campaign){
        $request->validate([
            'documents.*'=>'required|file|mimes: pdf,jpg,png,webp|max:2048'
        ]);

        foreach($request->file('documents') as $file){
        $path = $file->store('documents','public');

        CampaignDocument::create([
            'campaign_id'=> $campaign->id,
            'file_name'=> $file->getClientOriginalName(),
            'file_path'=> $path,
        ]);
         }

        $campaign->update([
            'document_requested'=>false,
            'ai_recommendation'=> "Review uploaded documents before approval",
            'ai_risk' => 'medium',
        ]);
        return redirect()->route("dashboard")->with('success',"Document uploaded successfully");
    }
}
