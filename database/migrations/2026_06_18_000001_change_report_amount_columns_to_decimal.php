<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE reports MODIFY sub_total DECIMAL(10, 2) NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE reports MODIFY tax_value DECIMAL(10, 2) NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE reports MODIFY tax DECIMAL(10, 2) NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE reports MODIFY total DECIMAL(10, 2) NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE reports MODIFY total_km DECIMAL(10, 2) NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE reports MODIFY km_price DECIMAL(10, 2) NOT NULL DEFAULT 0');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE reports MODIFY sub_total BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE reports MODIFY tax_value INT UNSIGNED NOT NULL DEFAULT 14');
        DB::statement('ALTER TABLE reports MODIFY tax BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE reports MODIFY total BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE reports MODIFY total_km BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE reports MODIFY km_price BIGINT UNSIGNED NOT NULL');
    }
};
