<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('userId');
            $table->string('name');
            $table->string('phone', 20);
            $table->string('division');
            $table->string('district')->nullable();
            $table->string('area');
            $table->string('address');
            $table->unsignedInteger('updatedByUserId')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('userId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('user_addresses');
    }
}
