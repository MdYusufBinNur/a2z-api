<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique()->nullable();
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('categoryId')->nullable();
            $table->string('title');
            $table->string('tag')->nullable();
            $table->string('ownerName')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoryId')
                ->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('brands');
    }
}
