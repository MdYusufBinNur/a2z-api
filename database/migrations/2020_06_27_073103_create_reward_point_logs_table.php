<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardPointLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_point_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orderId');
            $table->unsignedInteger('userId');
            $table->string('pointUsed')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('orderId')
                ->references('id')->on('orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('userId')
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
        Schema::dropIfExists('reward_point_logs');
    }
}
