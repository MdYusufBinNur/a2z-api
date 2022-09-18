<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('messageId');
            $table->unsignedInteger('fromUserId');
            $table->mediumText('text');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('messageId')
                ->references('id')->on('messages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('fromUserId')
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
        Schema::dropIfExists('message_posts');
    }
}
