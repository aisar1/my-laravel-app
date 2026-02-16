<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TrackingController;

// The 'api' prefix is automatic here
Route::get('/track/{tracking_number}', [TrackingController::class, 'show']);