<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('toUserId')->unsigned();
            $table->integer('fromUserId')->unsigned()->nullable();
            $table->integer('fromVendorId')->unsigned()->nullable();
            $table->integer('userNotificationTypeId')->unsigned()->nullable();
            $table->integer('resourceId')->unsigned()->nullable();
            $table->string('message')->nullable();
            $table->boolean('readStatus')->default(0);
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('toUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('fromUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('userNotificationTypeId')
                ->references('id')->on('user_notification_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('fromVendorId')
                ->references('id')->on('vendors')
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
        Schema::dropIfExists('user_notifications');
    }
}
