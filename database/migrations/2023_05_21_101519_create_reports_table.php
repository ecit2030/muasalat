<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sub_total");
            $table->unsignedInteger("tax_value")->default(14);
            $table->unsignedBigInteger("tax");
            $table->unsignedBigInteger("total");

            $table->unsignedBigInteger("total_km");
            $table->unsignedBigInteger("km_price");

            $table->string("payment_method")->default('credit')->comment('credit,subscription,cache');
            $table->string("reservation_type")->comment('other,talebat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
