<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ExtensionName;

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
            $table->enum('extension_name', ExtensionName::values())->nullable();
            
            //Contact Information
            $table->string('contact_number', 20);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
            // Role Management - Role and Status
            $table->unsignedInteger('role_id');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            
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
