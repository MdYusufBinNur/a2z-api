<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCashbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cashbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId');
            $table->unsignedInteger('orderDetailId');
            $table->unsignedInteger('userAccountId');
            $table->float('cashbackAmount');
            $table->date('date');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('orderDetailId')
                ->references('id')
                ->on('order_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('userAccountId')
                ->references('id')
                ->on('user_accounts')
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
        Schema::dropIfExists('order_cashbacks');
    }
}
