<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->string('type');
            $table->string('resourceId')->nullable();
            $table->string('fileName');
            $table->text('descriptions')->nullable();
            $table->string('fileType')->nullable();
            $table->double('fileSize')->nullable();
            $table->string('variation')->default('default');
            $table->boolean('hasAvatarSize')->default(0);
            $table->boolean('hasThumbnailSize')->default(0);
            $table->boolean('hasMediumSize')->default(0);
            $table->boolean('hasLargeSize')->default(0);
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
        Schema::dropIfExists('attachments');
    }
}
