<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique()->nullable();
            $table->unsignedInteger('parentId')->nullable();
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->mediumText('shortIntroduction')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('categoryId')->nullable();
            $table->unsignedInteger('subCategoryId')->nullable();
            $table->unsignedInteger('brandId')->nullable();
            $table->unsignedInteger('vendorId')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('brandId')
                ->references('id')->on('brands')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('categoryId')
                ->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('parentId')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('subCategoryId')
                ->references('id')->on('sub_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('vendorId')
                ->references('id')->on('vendors')
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
        Schema::dropIfExists('products');
    }
}
