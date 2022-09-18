<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingAndReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_and_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId');
            $table->string('type');
            $table->unsignedInteger('productId')->nullable();
            $table->unsignedInteger('vendorId')->nullable();
            $table->enum('rating', [1,2,3,4,5]);
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('productId')
                ->references('id')->on('products')
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
        Schema::dropIfExists('rating_and_reviews');
    }
}
