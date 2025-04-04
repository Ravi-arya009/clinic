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
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id');
            $table->uuid('dependant_id')->nullable()->foreign()->references('id')->on('dependants')->onDelete('cascade');
            $table->uuid('doctor_id');
            $table->uuid('clinic_id');
            $table->uuid('time_slot_id');
            $table->date('appointment_date');
            $table->tinyInteger('booking_for')->nullable(); //self, someone else
            $table->tinyInteger('appointment_type')->nullable(); //online, offline
            $table->tinyInteger('payment_method'); //online, offline
            $table->tinyInteger('status')->default(0); //pending, confirmed, cancelled etc.
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['clinic_id','doctor_id','time_slot_id', 'appointment_date'], 'unique_slot_per_patient');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
