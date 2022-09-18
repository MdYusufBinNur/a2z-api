<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('fromUserId');
            $table->unsignedInteger('toUserId')->nullable(); //nullable when group message
            $table->string('subject')->nullable();
            $table->boolean('isGroupMessage')->default(0);
            $table->mediumText('group')->nullable();
            $table->mediumText('groupNames')->nullable();
            $table->boolean('emailNotification')->default(0);
            $table->boolean('smsNotification')->default(0);
            $table->boolean('voiceNotification')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fromUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('toUserId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('createdByUserId')
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
        Schema::dropIfExists('messages');
    }
}
