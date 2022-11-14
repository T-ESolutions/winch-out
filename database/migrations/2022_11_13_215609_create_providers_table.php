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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('country_code');
            $table->string('phone')->unique();
            $table->string('user_phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->double('rate');
            $table->string('image')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_type')->nullable();
            $table->tinyInteger('active')->default(1)->comment('0->un_active and 1->active');
            $table->integer('suspend')->default(0);
            $table->timestamp('ios_deleted_at')->nullable();
            $table->string('fcm_token')->nullable();
            $table->enum('status',['pending','accepted','rejected'])->default('pending');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('address')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('providers');
    }
};
