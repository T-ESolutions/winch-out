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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number')->unique();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('provider_id')->nullable()->references('id')->on('providers')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('set null');
            $table->json('service_data');
            $table->json('brand_data');
            $table->json('modell_data');
            $table->string('car_year');
            $table->string('car_color');
            $table->double('distance')->default(0);
            $table->double('price_km')->default(0);
            $table->double('price_km_cost')->default(0);
            $table->double('free_km')->default(0);
            $table->double('free_km_cost')->default(0);
            $table->double('total_distance_cost')->default(0);
            $table->double('service_cost')->default(0);
            $table->double('car_category_cost')->default(0);
            $table->double('vat')->nullable();
            $table->double('discount')->nullable();
            $table->double('total_cost')->default(0);
            $table->string('status_ar');
            $table->string('status_en');
            $table->string('cancel_reason')->nullable();
            $table->string('cancel_note')->nullable();
            $table->enum('cancel_by',['user','provider','admin'])->nullable();
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
        Schema::dropIfExists('orders');
    }
};
