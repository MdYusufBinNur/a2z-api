<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('assignedToUserId')->nullable();
            $table->unsignedInteger('orderId')->nullable();
            $table->string('status');
            $table->mediumText('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_logs');
    }
}
