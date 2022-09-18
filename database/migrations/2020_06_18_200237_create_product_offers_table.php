<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productId');
            $table->unsignedInteger('vendorId');
            $table->unsignedInteger('brandId');
            $table->unsignedInteger('campaignId');
            $table->string('title')->nullable();
            $table->float('cashback')->nullable();
            $table->float('discount')->nullable();
            $table->char('discountType', 20)->nullable();
            $table->char('cashbackType', 20)->nullable();
            $table->integer('availableQuantity')->nullable();
            $table->date('startDate');
            $table->time('startTime');
            $table->date('endDate');
            $table->time('endTime');
            $table->boolean('isActive')->default(false);
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('updatedByUserId')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('campaignId')
                ->references('id')->on('campaigns')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('updatedByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('productId')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('vendorId')
                ->references('id')->on('vendors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('brandId')
                ->references('id')->on('brands')
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
        Schema::dropIfExists('product_offers');
    }
}
