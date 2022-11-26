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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('provider_id')->nullable()->references('id')->on('providers')->onDelete('restrict');
            $table->text('notes')->nullable();
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('set null');
            $table->json('service_data');
            $table->foreignId('service_car_category_id')->nullable()->references('id')->on('service_car_categories')->onDelete('set null');
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
            $table->double('vat')->default(0);
            $table->double('discount')->default(0);
            $table->double('extra_service_cost')->default(0);
            $table->double('total_cost')->default(0);
            $table->string('status_key')->comment('get this from table statuses');
//            $table->string('status_en')->comment('get this from table statuses');
//            $table->foreignId('status_id')->references('id')->on('statuses')->onDelete('cascade');

            $table->string('cancel_reason')->nullable();
            $table->string('cancel_note')->nullable();
            $table->enum('cancel_by', ['user', 'provider', 'admin'])->nullable();
            $table->time('time_to_cancel')->nullable();  // 8:10  hours
            $table->timestamp('reached_provider_at')->nullable();
            $table->string('distance_to_pickup')->nullable();
            $table->string('distance_to_drop_off')->nullable();
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
