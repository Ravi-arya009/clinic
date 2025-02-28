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
        Schema::create('dependents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('patient_id')->foreign()->references('id')->on('patients')->onDelete('cascade');
            $table->string('name');
            $table->string('phone', length: 13)->unique();
            $table->string('whatsapp', length: 13)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->integer('gender')->nullable(); //1 for male, 2 for female
            $table->date('dob')->nullable();
            $table->uuid('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete(null);
            $table->uuid('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete(null);
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();
            $table->string('profile_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependents');
    }
};
