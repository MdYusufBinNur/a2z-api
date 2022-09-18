<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundRequestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_request_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('refundRequestId');
            $table->string('status');
            $table->mediumText('comment')->nullable();
            $table->unsignedInteger('assignedToUserId')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('refundRequestId')
                ->references('id')->on('refund_requests')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('assignedToUserId')
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
        Schema::dropIfExists('refund_request_logs');
    }
}
