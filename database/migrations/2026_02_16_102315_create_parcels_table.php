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
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            // The unique code the user types in (e.g., AST-123456)
        $table->string('tracking_number')->unique()->index();
        
        // Basic receiver info
        $table->string('recipient_name');
        $table->string('recipient_phone')->nullable();
        
        // Courier info (e.g., 'poslaju', 'jnt', 'dhl')
        $table->string('courier_code'); 
        
        // Quick access to the latest status without joining tables
        $table->string('current_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};
