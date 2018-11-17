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
            $table->date('fulfillment_date');
            $table->enum('payment_status', ['paid', 'unpaid']);
            $table->enum('fulfillment_status', ['fulfilled', 'unfulfilled']);
            $table->string('shipping_address');
            $table->string('billing_address');
            $table->integer('shipping_method_id')->unsigned();
            
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
