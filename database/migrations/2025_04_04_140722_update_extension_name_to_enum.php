<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use App\Enums\ExtensionName; // Add this import

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tbl_users MODIFY COLUMN extension_name ENUM('" . implode("','", ExtensionName::values()) . "')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tbl_users MODIFY COLUMN extension_name VARCHAR(50)");
    }
};
