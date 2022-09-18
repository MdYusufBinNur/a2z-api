<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReturnAndDeliveryOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_return_and_delivery_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('productId');
            $table->longText('returnOptions')->nullable();
            $table->longText('deliveryOptions')->nullable();
            $table->boolean('isFreeDeliveryAvailable')->default(false);
            $table->boolean('isProductReturnable')->default(false);
            $table->unsignedInteger('updatedByUserId')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('updatedByUserId')
                ->references('id')->on('users')
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
        Schema::dropIfExists('product_return_and_delivery_options');
    }
}
