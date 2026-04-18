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
        Schema::create('attendance_sub_segments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('segment_id');
            $table->unsignedBigInteger('worker_id');
            $table->string('worker_name');
            $table->unsignedBigInteger('site_id');
            $table->string('site_name');
            $table->timestampTz('start_time');
            $table->timestampTz('end_time');
            $table->string('contract_type');
            $table->unsignedBigInteger('company_id');
            $table->string('company_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_subcontractor_segments');
    }
};
