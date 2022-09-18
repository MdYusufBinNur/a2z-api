<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paymentId')->unsigned();
            $table->string('providerName');
            $table->string('providerId')->nullable();
            $table->string('status');
            $table->string('paymentProcessURL')->nullable();
            $table->string('sourceURL');
            $table->mediumText('rawData')->nullable();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('payment_transactions');
    }
}
