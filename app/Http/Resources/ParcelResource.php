<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParcelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'tracking_code' => $this->tracking_number, // We can rename keys for the API
            'status' => $this->current_status,
            'courier' => strtoupper($this->courier_code),
            'last_updated' => $this->updated_at->diffForHumans(),
            // Transform the relationship data too
            'history' => $this->histories->map(function ($history) {
                return [
                    'status' => $history->status,
                    'location' => $history->location,
                    'description' => $history->description,
                    'date' => $history->occurred_at->format('d M Y, h:i A'),
                ];
            }),
        ];
    }
}