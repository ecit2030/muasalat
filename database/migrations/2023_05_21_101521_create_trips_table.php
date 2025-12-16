<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->nullable()->constrained('reports')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('track_id')->nullable()->constrained('tracks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("rate")->nullable();
            $table->string("comment")->nullable();
            $table->json("origin");
            $table->json("destination");
            $table->date("date");
            $table->timestamp("start_at")->nullable();
            $table->timestamp("end_at")->nullable();
            $table->nullableMorphs('created_by', 'created_by');
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
        Schema::dropIfExists('trips');
    }
};
