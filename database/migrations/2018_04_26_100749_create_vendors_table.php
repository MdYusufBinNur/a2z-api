<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique()->nullable();
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('tag', 20)->default(\App\DbModels\Vendor::TAG_NEW);
            $table->string('type', 20);
            $table->string('subCategoryIds')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->text('additionalNote')->nullable();
            $table->text('billingInfo')->nullable();
            $table->string('acceptPaymentMethods')->nullable();
            $table->unsignedInteger('userId')->nullable();
            $table->unsignedInteger('userRoleId')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('userId')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('userRoleId')
                ->references('id')->on('user_roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
