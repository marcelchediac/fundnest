<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    function Registerpage(){
        return view("auth.register");
    }

    function Loginpage(){
        return view("auth.login");
    }
    function about(){
        return view("about");
    }

    function home(){
        $userId = auth()->id();
        $favoriteCategory = DB::table('donations')
        ->join('campaigns', 'donations.campaign_id', '=', 'campaigns.id')
        ->join('categories','campaigns.category_id','=','categories.id')
        ->where('donations.user_id', $userId)
        ->select('categories.id','categories.name', DB::raw('COUNT(*) as total'))
        ->groupBy('categories.id','categories.name')
        ->orderByDesc('total')
        ->first();

    $recommended = collect();
    $favoriteCategoryId = null;

    if($favoriteCategory){
        $favoriteCategoryId = $favoriteCategory->id;
        $recommended = Campaign::where('category_id', $favoriteCategoryId)
                        ->where('status','approved')
                        ->latest()
                        ->take(5)
                        ->get();
    }

    $campaigns = Campaign::where('status', 'approved')->latest()->get();
     if($favoriteCategoryId){
        $campaigns = $campaigns->sortByDesc(function($campaign) use ($favoriteCategoryId) {
            return $campaign->category_id == $favoriteCategoryId ? 1 : 0;
        })->values(); 
    }

    return view("home", compact('campaigns', 'favoriteCategoryId'));
    }
    

    public function dashboard()
{
    $campaigns = auth()->user()->campaigns;
    return view('dashboard', compact('campaigns')); 
}

    function Helpcenter(){
        return view("Help Center");
    }

     function Register(Request $request){
        $fields=$request->validate([
            "name"=>["required"],
            "email"=>["required","unique:users,email"],
             "phone" => ["required",'unique:users,phone','regex:/^\+961\d{8}$/'],
            "password" => [
            "required",
            "min:8", 
            "confirmed",
            "regex:/^(?=.*[!@#$%^&*])(?=.*[A-Za-z])(?=.*\d).+$/"
        ],
            "terms"=>["required"],
            ],
            [
                "password.confirmed" => "Passwords do not match.",
                "password.regex" => "Password must include letters, numbers, and symbols.",
            ]); 

    $users=User::create($fields);
    return redirect() ->route('login')->with('success', 'Account created successfully. Please log in.');
    }

     function Login(Request $request){
        $fields=$request->validate([
            "email"=>["required"],
            "password"=>["required"]
        ]);

        if(Auth::attempt($fields)){

         $request->session()->regenerate();

        if(auth()->user()->role=='admin'){
            return redirect()->route("admin.campaigns");
        }
             return redirect()->intended(route("dashboard"));
        }

        return redirect()->back()
        ->withInput($request->only('email'))->with("error","email or password is incorrect");
    }

    function logoutPage(){
        Auth::logout();
        return redirect()->route("login");
    }
}

     
