<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('updatedByUserId')->nullable();
            $table->unsignedInteger('categoryId')->nullable();
            $table->unsignedInteger('subCategoryId')->nullable();
            $table->string('type');
            $table->string('title')->nullable();
            $table->string('params')->nullable();
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

            $table->foreign('categoryId')
                ->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('subCategoryId')
                ->references('id')->on('sub_categories')
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
        Schema::dropIfExists('content_modules');
    }
}
