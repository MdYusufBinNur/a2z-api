<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSpecsAndStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_specs_and_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('createdByUserId');
            $table->unsignedInteger('updatedByUserId')->nullable();
            $table->unsignedInteger('productId');
            $table->json('specifications')->nullable();
            $table->json('productStates')->nullable();
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

            $table->foreign('productId')
                ->references('id')->on('products')
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
        Schema::dropIfExists('product_specs_and_states');
    }
}
