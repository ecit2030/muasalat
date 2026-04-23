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
        Schema::create('frequency_transmissions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId('driver_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('vehicle_id')->nullable();
            $table->json("map_route_data")->nullable();
            $table->json("origin")->nullable();
            $table->json("destination")->nullable();
            $table->json("repeat")->nullable();
            $table->string("relay_point")->nullable();
            $table->dateTime("date_trans");
            $table->boolean('status_driver')->default(0);
            $table->boolean('is_active')->default(0);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable(); 

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frequency_transmissions');
    }
};
