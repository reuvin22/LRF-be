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
        Schema::create('site_assignments', function (Blueprint $table) {
            $table->id('assignment_id');

            $table->unsignedBigInteger('employee_id')->index();
            $table->unsignedBigInteger('site_id')->index();

            $table->boolean('is_leader')->default(false)->index();

            $table->date('start_date')->index();
            $table->date('end_date')->nullable()->index();

            $table->timestamps();

            // Composite indexes
            $table->index(['site_id', 'employee_id']);
            $table->index(['employee_id', 'site_id']);
            $table->index(['site_id', 'is_leader']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_assignments');
    }
};
