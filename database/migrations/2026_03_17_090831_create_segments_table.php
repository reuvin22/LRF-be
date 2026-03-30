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
       Schema::create('segments', function (Blueprint $table) {
            $table->id('segment_id');
            $table->unsignedBigInteger('attendance_id');
            $table->string('type');
            $table->enum('segment_type', ['TRAVEL', 'SITE', 'OFFICE']);
            $table->string('site_id')->nullable();
            $table->string('site_name')->nullable();
            $table->timestampTz('start_time');
            $table->timestampTz('end_time')->nullable();

            $table->string('site_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segments');
    }
};
