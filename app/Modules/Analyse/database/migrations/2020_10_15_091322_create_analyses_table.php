<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyses', function (Blueprint $table) {

            $table->id();
            $table->string('type')->nullable();
            $table->boolean('done')->nullable()->default(false);
            $table->string('status')->nullable()->default('new');
            $table->text('title')->nullable();
            $table->text('insightClass')->nullable();
            $table->text('file')->nullable();
            $table->text('diff')->nullable();
            $table->text('line')->nullable();
            $table->text('message')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('analyses');
    }
};