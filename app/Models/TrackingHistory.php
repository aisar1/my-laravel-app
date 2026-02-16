<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingHistory extends Model
{
    protected $fillable = [
        'parcel_id', 'status', 'location', 'description', 'occurred_at'
    ];

    protected $casts = [
        'occurred_at' => 'datetime', // This converts the string to a Carbon object
    ];
}