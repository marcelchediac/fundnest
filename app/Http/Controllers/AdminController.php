<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use Carbon\Carbon;

class AdminController extends Controller
{
    
public function index(Request $request)
{

$status = $request->status ?? 'pending'; 
$filter = $request->filter;

$query = Campaign::with('user')->where('status', $status);

if ($filter == 'week') {
    $query->where('created_at', '>=', Carbon::now()->subWeek());
}

elseif ($filter == 'month') {
    $query->where('created_at', '>=', Carbon::now()->subMonth());
}

elseif ($filter == '6months') {
    $query->where('created_at', '>=', Carbon::now()->subMonths(6));
}

elseif ($filter == 'year') {
    $query->where('created_at', '>=', Carbon::now()->subYear());
}

$campaigns = $query->latest()->get();

$stats = [
'pending' => Campaign::where('status','pending')->count(),
'approved' => Campaign::where('status','approved')->count(),
'rejected' => Campaign::where('status','rejected')->count(),
'completed' => Campaign::where('status','completed')->count(),
'raised' => Campaign::sum('collected_amount'),
];

return view('admin.index', compact('campaigns','stats','status','filter'));
}


    public function approve(Campaign $campaign)
    {
        $campaign->update(['status' => 'approved']);
        return redirect()->route('admin.campaigns')->with('success', 'Campaign approved');
    }

    public function reject(Campaign $campaign)
    {
        $campaign->update(['status' => 'rejected']);
        return redirect()->route('admin.campaigns')->with('error', 'Campaign rejected');
    }

    public function campaignsByStatus($status = 'pending'){
        $campaigns = Campaign::where('status', $status)->get();

        $stats= [
            'pending' => Campaign::where('status','pending')->count(),
            'approved' => Campaign::where('status','approved')->count(),
            'rejected' => Campaign::where('status','rejected')->count(),
            'completed' => Campaign::where('status','completed')->count(),
             'raised'  => Campaign::sum('collected_amount'),

        ];
        return view('admin.index', compact('campaigns','stats','status'));
    }

    public function request(Campaign $campaign){
        $campaign->document_requested = true;
        $campaign->save();
        return redirect()->back()->with("success","Document request sent successfully");
    }
    }
