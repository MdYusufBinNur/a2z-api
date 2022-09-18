<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone', 25)->unique()->nullable();
            $table->string('password')->nullable();;
            $table->string('locale')->default('en');
            $table->integer('isActive')->default(0);
            $table->dateTime('lastLoginAt')->nullable();
            $table->dateTime('notificationSeenAt')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('createdByUserId')->unsigned()->nullable();
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
        Schema::dropIfExists('users');
    }
}
