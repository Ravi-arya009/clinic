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
        Schema::create('appointment_lab_tests', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->uuid('lab_test_id');
            $table->foreign('lab_test_id')->references('id')->on('lab_test_masters')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['appointment_id', 'lab_test_id'], 'unique_lab_test_per_appointment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_lab_tests');
    }
};
