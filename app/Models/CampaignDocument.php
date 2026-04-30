<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignDocument extends Model
{
    protected $fillable= [
        'campaign_id',
        'file_name',
        'file_path',
    ];
    
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
