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
        Schema::create('clinics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('phone', length: 13)->unique()->nullable();
            $table->string('whatsapp', length: 13)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_person_phone', length: 13)->unique()->nullable();
            $table->string('contact_person_whatsapp', length: 13)->nullable();
            $table->uuid('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->uuid('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->string('address')->nullable();
            $table->string('pincode', 8)->nullable();
            $table->string('area')->nullable();
            $table->uuid('speciality_id')->nullable();
            $table->foreign('speciality_id')->references('id')->on('specialities')->onDelete('set null');
            $table->string('logo')->nullable();
            $table->string('super_admin')->nullable(); //nullable for now. it stores which superadmin created the clinic.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
