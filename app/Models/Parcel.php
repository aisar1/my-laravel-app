<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parcel extends Model
{
    protected $fillable = [
        'tracking_number', 'recipient_name', 'recipient_phone', 
        'courier_code', 'current_status'
    ];

    public function histories(): HasMany
    {
        // Orders the history so the newest event is first
        return $this->hasMany(TrackingHistory::class)->orderBy('occurred_at', 'desc');
    }
}