<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('order_date');
            $table->date('fulfillment_date')->nullable();
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('fulfillment_status', ['fulfilled', 'unfulfilled'])->default('unfulfilled');
            $table->string('shipping_address');
            $table->string('billing_address');
            $table->integer('shipping_method_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');

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
}
