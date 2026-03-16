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
        Schema::create('site_subcontractors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('site_id')->index();
            $table->unsignedBigInteger('subcontractor_id')->index();

            $table->enum('contract_type', [
                'QUASI_DELEGATION',
                'FIXED_PRICE'
            ])->index();

            $table->timestamps();

            $table->index(['site_id', 'subcontractor_id']);
            $table->index(['subcontractor_id', 'site_id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_sub_contractors');
    }
};
