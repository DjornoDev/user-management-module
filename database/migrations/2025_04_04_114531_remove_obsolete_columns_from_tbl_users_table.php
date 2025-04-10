<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'place_of_birth',
                'sex',
                'age',
                'citizenship',
                'religion',
                'birth_order',
                'no_of_siblings',
                'address',
                'blood_type',
                'civil_status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            //
        });
    }
};
