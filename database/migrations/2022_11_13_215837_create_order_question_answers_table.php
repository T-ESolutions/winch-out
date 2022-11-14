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
        Schema::create('order_question_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_question_id')->references('id')->on('order_questions')->onDelete('cascade');
            $table->string('answer');
            $table->string('type')->comment("'text','radio','checkbox','image'");
            $table->tinyInteger('provider_approval')->nullable()->comment("0=>rejected | 1=>accepted");
            $table->text('reject_reason')->nullable();
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
        Schema::dropIfExists('order_question_answers');
    }
};
