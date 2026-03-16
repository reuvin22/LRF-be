<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ocr_upload_categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('category_name');
            $table->string('description')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); // Required
            $table->timestamps();
        });

        DB::table('ocr_upload_categories')->insert([
            [
                'category_name' => 'Ad-hoc transportation expense claim',
                'description' => "Employee's own transportation receipt",
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Subcontractor invoice',
                'description' => 'Invoice received at the construction site',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocr_upload_categories');
    }
};
