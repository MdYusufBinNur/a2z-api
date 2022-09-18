<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->string('title');
            $table->mediumText('text');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('message_templates');
    }
}
