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
        Schema::create('tbl_users', function (Blueprint $table) {
            // Personal Information
            $table->increments('user_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('extension_name', 50)->nullable();
            
            //Contact Information
            $table->string('contact_number', 20);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
            // Role Management - Role and Status
            $table->unsignedInteger('role_id');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            
            // Student Applicant Fields
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->enum('sex', ['male', 'female', 'other'])->nullable();
            $table->integer('age')->nullable();
            $table->string('citizenship')->nullable();
            $table->text('address')->nullable();
            $table->string('blood_type')->nullable();
            $table->enum('civil_status', ['Married', 'Single', 'Divorced', 'Widowed'])->nullable();
            $table->string('religion')->nullable();
            $table->string('birth_order')->nullable();
            $table->string('no_of_siblings')->nullable();
            
            // Common Fields
            $table->string('profile_picture')->nullable();
            $table->boolean('email_verified')->default(false);
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        
            $table->foreign('role_id')->references('role_id')->on('tbl_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_users');
    }
};
