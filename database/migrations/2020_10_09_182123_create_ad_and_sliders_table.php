<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdAndSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_and_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('vendorId')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('tag')->nullable();
            $table->string('priority')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
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
        Schema::dropIfExists('ad_and_sliders');
    }
}
