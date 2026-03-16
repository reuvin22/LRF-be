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
        Schema::create('ocr_uploads', function (Blueprint $table) {
            $table->id('upload_id');
            $table->unsignedBigInteger('uploaded_by');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('site_id')->nullable();
            $table->unsignedBigInteger('subcontractor_id')->nullable();
            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->enum('upload_source', ['LINE', 'Web']);
            $table->string('image_path');
            $table->enum('status', ['pending', 'processing', 'completed', 'error'])->default('pending');
            $table->integer('ocr_result_amount')->nullable();
            $table->date('ocr_result_date')->nullable();
            $table->text('ocr_result_raw')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->timestamp('confirmed_at')->nullable();
            $table->string('note')->nullable();
            $table->timestamp('uploaded_at');
            $table->timestamp('processed_at')->nullable();

            $table->timestamps();

            $table->foreign('uploaded_by')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('ocr_upload_categories')->onDelete('cascade');
            $table->foreign('site_id')->references('site_id')->on('sites')->onDelete('set null');
            $table->foreign('subcontractor_id')->references('subcontractor_id')->on('subcontractors')->onDelete('set null');
            $table->foreign('confirmed_by')->references('employee_id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocr_uploads');
    }
};
