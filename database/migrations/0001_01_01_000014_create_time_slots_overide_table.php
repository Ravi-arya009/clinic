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
        Schema::create('time_slots_overide', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('slot_id');
            $table->uuid('doctor_id');
            $table->dateTime('slot_time');
            $table->integer('status');
            $table->string('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slots_overide');
    }
};
