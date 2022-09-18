<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStockOutLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_out_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId');
            $table->unsignedInteger('productId');
            $table->string('resourceItem')->nullable();
            $table->string('startingQuantity')->nullable();
            $table->string('decreaseQuantity')->nullable();
            $table->string('availableQuantity')->nullable();
            $table->string('note')->nullable();
            $table->string('amount')->nullable();
            $table->string('date')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('productId')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('createdByUserId')
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
        Schema::dropIfExists('product_stock_out_logs');
    }
}
