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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('work_date');
            $table->enum('status', ['WORKING', 'END_OF_DAY', 'NOT_STARTED']);
            $table->integer('total_work_minutes')->default(0);
            $table->integer('overtime_minutes')->default(0);
            $table->timestamps();
            $table->foreign('attendance_id')
                ->references('attendance_id')
                ->on('segments')
                ->onDelete('cascade');
            $table->foreign('attendance_id')
                ->references('attendance_id')
                ->on('transportation_expenses')
                ->onDelete('cascade');
            $table->foreign('attendance_id')
                ->references('attendance_id')
                ->on('subcontractors')
                ->onDelete('cascade');
            $table->foreign('attendance_id')
                ->references('attendance_id')
                ->on('subcontractor_reports')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
