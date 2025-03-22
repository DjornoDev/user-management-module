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
        Schema::create('tbl_audit_log', function (Blueprint $table) {
            $table->unsignedInteger('log_id')->autoIncrement();
            $table->unsignedInteger('user_id');
            $table->string('action', 255);
            $table->timestamp('timestamp')->useCurrent();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('tbl_users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_audit_log');
    }
};
