<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('orderId');
            $table->unsignedInteger('paymentId');
            $table->unsignedInteger('requestPaymentMethod')->nullable();
            $table->float('amount');
            $table->string('status');
            $table->mediumText('comment')->nullable();
            $table->unsignedInteger('assignedToUserId')->nullable();
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

            $table->foreign('assignedToUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('orderId')
                ->references('id')->on('orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('paymentId')
                ->references('id')->on('payments')
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
        Schema::dropIfExists('refund_requests');
    }
}
