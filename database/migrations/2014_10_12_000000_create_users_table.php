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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_notifiable')->default(1);
            $table->string('social_id')->nullable();
            $table->string('slug')->nullable()->unique();
            // driver -- captain
            $table->date('date_of_birth')->nullable();
            $table->string('ussid_number')->nullable()->unique();
            $table->string('driver_license_number')->nullable()->unique();
            $table->date('driver_license_end_date')->nullable();
            // driver -- captain -- organization
            $table->string('bank_name')->nullable();
            $table->string('bank_personal_id')->nullable()->unique();
            $table->string('iban')->nullable()->unique();
            // captain -- organization
            $table->double('talebat_price')->nullable();
            $table->double('other_price')->nullable();
            $table->boolean('update_price')->default(0);
            // captain
            $table->enum('status', ["verify_code", "complete_personal", "complete_vehicle", "pending", "active"])->default("active");
            // driver
            $table->unsignedInteger('organization_id')->nullable();
            // oragnization
            $table->string('organization_name')->nullable()->unique();
            $table->string('organization_commercial_number')->nullable()->unique();
            $table->string("address")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->integer("balance")->default(0);
            $table->string("reason")->nullable();
            $table->integer("login_count")->default(0);
            $table->dateTime("last_login")->nullable();
            $table->string('wasl_status')->nullable()->comment('current status of driver for wasl');
            $table->json('wasl_rejections')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
