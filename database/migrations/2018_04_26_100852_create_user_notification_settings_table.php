<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('userId');
            $table->integer('typeId')->nullable();
            $table->boolean('email')->default(1);
            $table->boolean('sms')->default(1);
            $table->boolean('voice')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('userId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique(['userId', 'typeId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notification_settings');
    }
}
