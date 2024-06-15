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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('_customer_id')->nullable();
            $table->bigInteger('_customer_address_id')->nullable();
            $table->bigInteger('creadted_by')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('image')->nullable();
            $table->string('item_description')->nullable();
            $table->longText('remark')->nullable();
            $table->enum('status',["Open","Hold","Close","Re-Open","Processing"])->default('Open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
