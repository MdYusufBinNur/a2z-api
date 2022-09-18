<?php

use Carbon\Traits\Date;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique()->nullable();
            $table->unsignedInteger('createdByUserId')->nullable();
            $table->unsignedInteger('updatedByUserId')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('startDate');
            $table->time('startTime');
            $table->date('endDate');
            $table->time('endTime');
            $table->string('host')->nullable();
            $table->boolean('isActive')->default(false);
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
        Schema::dropIfExists('campaigns');
    }
}
