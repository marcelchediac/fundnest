<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ChatController;

use App\Http\Controllers\CampaignDocumentController;




Route::get('/',[AuthController::class,'home'])->name("home");

Route::get('/HelpCenter',[AuthController::class,'Helpcenter'])->name("Helpcenter");

Route::get('/contact',[ContactController::class,'contact'])->name("contact");
Route::post('/contact',[ContactController::class,'store'])->name("contact.store");

Route::middleware("guest")->group (function(){
Route::get('/register',[AuthController::class,'Registerpage'])->name("Register");
Route::post('/register',[AuthController::class,'Register'])->name("RegisterAction");
Route::get('/login',[AuthController::class,'Loginpage'])->name("login");
Route::post('/login',[AuthController::class,'Login'])->name("LoginAction");
});

Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaign.create')->middleware(['auth','isUser']);
Route::post('/campaigns/create', [CampaignController::class, 'store'])->name('campaign.store')->middleware(['auth','isUser']);

Route::middleware('auth')->group(function(){
Route::get("/logout",[AuthController::class ,'logoutPage'])->name("logout");
Route::get('/campaigns/{campaign}/donate', [DonationController::class, 'create'] )->name('donations.create');
Route::post('/campaigns/{campaign}/donate',  [DonationController::class, 'store'] )->name('donations.store');
Route::get('/dashboard', [App\Http\Controllers\AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/campaigns/{campaign}/upload', [CampaignDocumentController::class, 'create'])->name('campaign.documents.upload');
Route::post('/campaigns/{campaign}/upload', [CampaignDocumentController::class, 'store'])->name('campaign.documents.store');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/campaigns', [AdminController::class, 'index'] )->name('admin.campaigns');
    Route::post('/campaigns/{campaign}/approve', [AdminController::class, 'approve'])->name('admin.campaigns.approve');
    Route::post('/campaigns/{campaign}/reject', [AdminController::class, 'reject'])->name('admin.campaigns.reject');
     Route::post('/campaigns/{campaign}/request', [AdminController::class, 'request'])->name('admin.campaigns.requestDocuments');

});

Route::post('/chatbot/ask', [ChatController::class, 'chat'])->name('chatbot.ask');
Route::post('/Ai/call', [CampaignController::class, 'analyzeCampaign'])->name('Ai.call');

Route::get('/admin/campaigns/status/{status?}',[AdminController::class,'campaignsByStatus'])->name('admin.campaigns.status');

Route::get('/campaign/{id}', [CampaignController::class,'show'])->name('campaign.show');
Route::post('/campaign/{id}', [CampaignController::class,'comment'])->name('campaign.comment');
Route::get('/about',[AuthController::class,'about'])->name('about');
