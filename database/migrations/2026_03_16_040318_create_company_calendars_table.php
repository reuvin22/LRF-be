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
        Schema::create('company_calendars', function (Blueprint $table) {
            $table->date('date')->primary();
            $table->enum('day_type', ['WORKDAY', 'HOLIDAY', 'LEGAL_HOLIDAY', 'NATIONAL_HOLIDAY']);
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_calendars');
    }
};
