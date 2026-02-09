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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            // Personal Info
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        
        // Job Details
        $table->string('department'); // e.g., IT, HR, Sales
        $table->string('position');   // e.g., Manager, Developer
        $table->decimal('salary', 10, 2); // 10 digits total, 2 decimal places
        $table->date('joining_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
