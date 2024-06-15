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
         Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('profile_image')->nullable();
            $table->string('user_name', 100)->nullable();
            $table->string('mobile_no', 100)->nullable();
            $table->string('aadhar_no', 100)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('dob', 100)->nullable();
            $table->string('doj', 100)->nullable();
            $table->string('driving_license_no', 100)->nullable();
            $table->longText('address')->nullable();
            $table->enum('status',["1","0"])->default('1');
            $table->timestamps();
            $table->softDeletes();

            // Add any additional columns or modifications to the table structure here.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
