<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orderId');
            $table->string('invoice');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('productOfferId')->nullable();
            $table->unsignedInteger('productId');
            $table->float('productPrice');
            $table->string('productQuantity');
            $table->string('color', 20)->nullable();
            $table->string('size',20)->nullable();
            $table->string('comment')->nullable();
            $table->string('cashbackStatus', 20);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('productOfferId')
                ->references('id')->on('product_offers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('orderId')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
