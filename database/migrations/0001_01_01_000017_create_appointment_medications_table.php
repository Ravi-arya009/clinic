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
        Schema::create('appointment_medications', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->uuid('medicine_id');
            $table->foreign('medicine_id')->references('id')->on('medicine_masters')->onDelete('cascade');
            $table->string('dosage');
            $table->string('duration');
            $table->string('instructions')->nullable();
            $table->timestamps();
            $table->unique(['appointment_id', 'medicine_id'], 'unique_medicine_per_appointment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_medications');
    }
};
