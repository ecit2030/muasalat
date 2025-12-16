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
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('driver_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('vehicle_year_id')->constrained('vehicle_years')->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('sequence_number')->nullable()->unique();
            $table->integer("vehicle_number");
            $table->string("vehicle_letter");
            $table->string("color");

            $table->date("license_end_date");
            $table->date("ensurance_end_date");
            $table->date("periodic_end_date");

            $table->unique(['vehicle_number', 'vehicle_letter']);

            $table->boolean('is_active')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('user_vehicles');
    }
};
