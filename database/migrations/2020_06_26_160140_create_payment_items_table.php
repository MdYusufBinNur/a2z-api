<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->string('refId');
            $table->integer('paymentMethodId')->unsigned();
            $table->integer('paymentId')->unsigned()->nullable();
            $table->string('providerName')->nullable();
            $table->string('invoice', 30);
            $table->date('paymentDate')->nullable();
            $table->float('amount');
            $table->text('note')->nullable();
            $table->string('status', 20)->nullable();
            $table->string('paymentProcessURL')->nullable();
            $table->integer('vouchedId')->unsigned()->nullable();
            $table->integer('updatedByUserId')->unsigned()->nullable();
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

            $table->foreign('paymentMethodId')
                ->references('id')->on('payment_methods')
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
        Schema::dropIfExists('payment_items');
    }
}
