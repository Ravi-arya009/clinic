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
        Schema::create('clinic_working_hours', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->tinyInteger('day')->comment('1:Monday, 2:Tuesday, 3:Wednesay...');
            $table->tinyInteger('shift')->comment('1:Morning, 2:Afternoon, 3:Evening, 4:Night...');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Unique constraint to prevent duplicate entries
            $table->unique(['clinic_id', 'day', 'shift', 'opening_time', 'closing_time'], 'clinic_hours_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_working_hours_tables');
    }
};
