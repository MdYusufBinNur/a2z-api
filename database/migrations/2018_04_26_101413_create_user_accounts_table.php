<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->unsignedInteger('userId');
            $table->float('balanceAmount')->default(0.0)->nullable();
            $table->float('holdingAmount')->default(0.0)->nullable();
            $table->float('giftCardAmount')->default(0.0)->nullable();
            $table->float('cashbackAmount')->default(0.0)->nullable();
            $table->string('status');
            $table->string('currency')->default('BDT')->nullable();
            $table->mediumText('note')->nullable();
            $table->integer('updatedByUserId')->unsigned()->nullable();
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
        Schema::dropIfExists('user_accounts');
    }
}
