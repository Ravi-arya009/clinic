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
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->uuid('doctor_id');
            $table->uuid('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->time('slot_time');
            $table->integer('day_of_week');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->unique(['doctor_id', 'slot_time', 'day_of_week'], 'unique_slot_per_doctor');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        // // Drop the foreign key constraint first
        // Schema::table('time_slots', function (Blueprint $table) {
        //     $table->dropForeign(['clinic_id']); // Drop the foreign key
        // });

        Schema::dropIfExists('time_slots');
    }
};
