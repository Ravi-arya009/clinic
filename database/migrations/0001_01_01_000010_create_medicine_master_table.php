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
        Schema::create('medicine_masters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('composition')->nullable();
            $table->uuid('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->unique(['name', 'clinic_id'], 'unique_medicine_per_clinic');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_master');
    }
};
