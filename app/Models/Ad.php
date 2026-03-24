<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertiser_id',
        'title',
        'url',
        'reward_amount',
        'duration_seconds',
        'total_clicks',
        'remaining_clicks',
        'status',
        'country_targets',
        'device_targets',
    ];

    protected $casts = [
        'country_targets' => 'array',
        'device_targets' => 'array',
    ];

    public function advertiser()
    {
        return $this->belongsTo(User::class, 'advertiser_id');
    }
}
