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
            $table->string('invoice')->unique();
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('assignedToUserId')->nullable();
            $table->string('status');
            $table->float('amount');
            $table->float('discount')->nullable()->default(0.0);
            $table->string('phone', 20);
            $table->mediumText('address');
            $table->string('paymentStatus');
            $table->unsignedInteger('voucherId')->nullable();
            $table->unsignedInteger('campaignId')->nullable();
            $table->unsignedInteger('vendorId');
            $table->unsignedInteger('orderTypeId');
            $table->boolean('acceptTAC')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('assignedToUserId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('orderTypeId')
                ->references('id')
                ->on('order_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('campaignId')
                ->references('id')
                ->on('campaigns')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('vendorId')
                ->references('id')
                ->on('vendors')
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
        Schema::dropIfExists('orders');
    }
}
