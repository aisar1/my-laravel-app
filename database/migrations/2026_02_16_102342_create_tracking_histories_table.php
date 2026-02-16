<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tracking_histories', function (Blueprint $table) {
            $table->id();
            // Link to the parcel
        $table->foreignId('parcel_id')->constrained('parcels')->onDelete('cascade');
        
        // The status of this specific event
        $table->string('status'); // e.g., 'picked_up', 'in_transit', 'delivered'
        
        // Where it happened
        $table->string('location')->nullable(); // e.g., 'Puchong Hub', 'KLIA'
        
        // detailed description
        $table->text('description')->nullable(); 
        
        // When the event actually happened (might be different from created_at)
        $table->timestamp('occurred_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_histories');
    }
};
