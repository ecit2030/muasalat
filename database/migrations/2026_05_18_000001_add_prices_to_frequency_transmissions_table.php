<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('frequency_transmissions', function (Blueprint $table) {
            $table->decimal('oneway_price', 10, 2)->nullable()->after('details');
            $table->decimal('round_price', 10, 2)->nullable()->after('oneway_price');
        });
    }

    public function down(): void
    {
        Schema::table('frequency_transmissions', function (Blueprint $table) {
            $table->dropColumn(['oneway_price', 'round_price']);
        });
    }
};
