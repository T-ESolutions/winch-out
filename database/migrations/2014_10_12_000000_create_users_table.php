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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('country_code')->default('+20'); //+20
            $table->string('phone')->unique(); //1094641332
            $table->string('user_phone')->unique(); //+201094641332
            $table->string('password');
            $table->double('rate')->default(0);
            $table->string('image')->nullable();
            $table->string('social_id')->nullable(); //facebook //google
            $table->string('social_type')->nullable(); //facebook //google
            $table->tinyInteger('active')->default(1)->comment('0->un_active and 1->active');
            $table->tinyInteger('suspend')->default(0);
            $table->string('fcm_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('ios_deleted_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};
