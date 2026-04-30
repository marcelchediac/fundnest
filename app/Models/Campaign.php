<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'goal_amount',
        'current_amount',
        'image',
        'status',
        'video_url',
        'ai_summary',
        'ai_risk',
        'ai_recommendation',
        'document',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

     public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function category()
{
    return $this->belongsTo(Category::class);
}

public function documents()
{
    return $this->hasMany(CampaignDocument::class);
}
public function calculateRiskLevel(){
    $hasDocument = $this->documents()->exists();
    $descriptionLength= strlen($this->description);
    $goalAmount = $this->goal_amount;

    if(!$hasDocument){
        return 'High';
    }
    if($descriptionLength< 100 || $goalAmount> 10000){
        return "Medium";

    }
    return "Low";
}
}
