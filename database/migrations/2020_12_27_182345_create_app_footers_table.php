<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_footers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->string('content')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('details')->nullable();
            $table->boolean('isActive')->default(true);
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
        Schema::dropIfExists('app_footers');
    }
}
