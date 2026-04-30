<?php

namespace App\Http\Controllers;
use App\Models\Campaign;

use Illuminate\Http\Request;

class DonationController extends Controller
{

public function create(Campaign $campaign){

    return view('donations.create', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
{         $user = auth()->user();

    if ($campaign->user_id === $user->id) {
        return redirect()->back()->with('error', "You cannot donate to your own campaign.");
    }

    if ($campaign->status !== 'approved') {
        return back()->with('error', 'This campaign is not accepting donations.');
    }

    $request->validate([
        'amount' => 'required|numeric|min:1',
        'anonymous' => 'nullable|boolean'
    ]);

    $donationAmount = $request->amount;
    $remaining = $campaign->goal_amount - $campaign->collected_amount;

    if ($donationAmount > $remaining) {
        return back()->with('error', "You can only donate up to $$remaining for this campaign.");
    }

    $donorName = $request->boolean('anonymous') ? 'Anonymous' : auth()->user()->name;

    $campaign->donations()->create([
        'user_id' => auth()->id(),
        'amount' => $donationAmount,
        'status' => 'active',
        'donor_name' => $donorName,
    ]);

    $campaign->collected_amount += $donationAmount;

    if ($campaign->collected_amount == $campaign->goal_amount) {
        $campaign->status = 'completed';
    }

    $campaign->save();

    return back()->with('success', 'Thank you for your donation!');
}
}
