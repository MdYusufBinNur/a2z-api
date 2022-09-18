<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaAndSlugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_and_slugs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->integer('resourceId')->nullable();
            $table->string('type');
            $table->string('routePath');
            $table->string('slugPath')->nullable();
            $table->string('keywords')->nullable();
            $table->unsignedInteger('updatedByUserId')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('meta_and_slugs');
    }
}
