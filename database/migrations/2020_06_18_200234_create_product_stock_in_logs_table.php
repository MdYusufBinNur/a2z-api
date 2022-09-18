<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStockInLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_in_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId');
            $table->unsignedInteger('productId');
            $table->unsignedInteger('vendorId')->nullable();
            $table->integer('startingQuantity')->nullable();
            $table->integer('receivedQuantity')->nullable();
            $table->integer('availableQuantity')->nullable();
            $table->date('date')->nullable();
            $table->string('note')->nullable();
            $table->float('cost')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('vendorId')
                ->references('id')->on('vendors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('productId')
                ->references('id')->on('products')
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
        Schema::dropIfExists('product_stock_in_logs');
    }
}
