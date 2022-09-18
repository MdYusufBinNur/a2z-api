<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->integer('paymentId')->unsigned()->nullable();
            $table->integer('paymentTransactionId')->unsigned()->nullable();
            $table->string('paymentMethod')->nullable();
            $table->integer('cashReceivedById')->unsigned()->nullable();
            $table->float('paid')->nullable();
            $table->float('due')->nullable();
            $table->float('advance')->nullable();
            $table->string('status')->nullable();
            $table->string('event')->nullable();
            $table->string('note')->nullable();
            $table->integer('updatedByUserId')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('paymentId')
                ->references('id')->on('payments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('paymentTransactionId')
                ->references('id')->on('payment_transactions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cashReceivedById')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('updatedByUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_logs');
    }
}
