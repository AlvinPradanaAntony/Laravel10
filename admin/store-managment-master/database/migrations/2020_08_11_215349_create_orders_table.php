<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('customer_phone');
            $table->string('customer_alt_phone')->nullable();
            $table->string('customer_address');
            $table->decimal('delivery_price')->nullable();
            $table->decimal('added_price')->nullable();
            $table->decimal('discount')->default(0);
            $table->decimal('total_price')->default(0);
            $table->string('status')->default(Config::get('constants.order.not_delivered'));
            $table->foreignId('delivery_man_id')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('delivery_man_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
}
