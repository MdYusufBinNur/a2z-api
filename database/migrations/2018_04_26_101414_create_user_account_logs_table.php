<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('userAccountId');
            $table->integer('resourceId')->unsigned()->nullable();
            $table->string('resourceType')->nullable();
            $table->mediumText('reason')->nullable();
            $table->string('type');
            $table->string('method', 10);
            $table->float('amount')->default(0.0);
            $table->dateTime('date');
            $table->integer('updatedByUserId')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('userAccountId')
                ->references('id')->on('user_accounts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('updatedByUserId')
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
        Schema::dropIfExists('user_account_logs');
    }
}
