<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Http\Resources\ParcelResource;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Handle the incoming tracking request.
     */
    public function show($trackingNumber)
    {
        // 1. Find the parcel or fail (automatically returns 404 JSON if missing)
        $parcel = Parcel::with('histories')
            ->where('tracking_number', $trackingNumber)
            ->firstOrFail();

        // 2. Return the data wrapped in our Resource
        return new ParcelResource($parcel);
    }
}