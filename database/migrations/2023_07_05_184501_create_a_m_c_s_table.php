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
        Schema::create('amcs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('_user_id')->nullable();
            $table->string('_customer_details_id')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('contract_amount')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('amc_visit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('_amc_id')->nullable();
            $table->string('visit_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.database\migrations\2023_07_05_184501_create_a_m_c_s_table.php
     */
    public function down(): void
    {
        Schema::dropIfExists('amcs');
    }
};
