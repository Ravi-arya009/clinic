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
        Schema::create('clinic_working_hours_override_tables', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->date('date');
            $table->enum('shift', ['1', '2', '3', '4'])->comment('1:Morning, 2:Afternoon, 3:Evening, 4:Night');
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->boolean('closed')->default(false)->comment('true: opened for this shift, false: closed for this shift');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_working_hours_override_tables');
    }
};
