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
        Schema::create('jobs', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('complaint_id');
            $table->string('job_ref_no', 60)->unique();
            $table->enum('priority', ['High', 'Medium', 'Low'])->default('Low');
            $table->string('job_start_time')->nullable();
            $table->string('job_end_time')->nullable();
            $table->string('job_completion_at')->nullable();
            $table->string('product')->nullable();
            $table->longText('product_model_details')->nullable();
            $table->string('product_image')->nullable();
            $table->string('estimated_cost')->nullable();
            $table->enum('payment_type', ['Cash', 'Card', 'Cheque','Online'])->default('Cash');
            $table->string('job_category')->nullable();
            $table->longText('job_description')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('supervisor_name')->nullable();
            $table->string('supervisor_mobile_no')->nullable();
            $table->enum('status', ['Pending', 'Hold', 'Assign', 'Complete']);
            $table->unsignedBigInteger('technician_id')->default('0');
            $table->unsignedBigInteger('_created_by')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
