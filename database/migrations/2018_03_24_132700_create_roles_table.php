<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->string('type');
            $table->string('title');
            $table->timestamps();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->softDeletes();
        });

        DB::table('roles')->insert([
            ['id' => 1, 'type' => 'admin', 'title' => 'super_admin'],
            ['id' => 2, 'type' => 'admin', 'title' => 'standard_admin'],
            ['id' => 3, 'type' => 'admin', 'title' => 'limited_admin'],

            ['id' => 4, 'type' => 'staff', 'title' => 'standard_staff'],
            ['id' => 5, 'type' => 'staff', 'title' => 'limited_staff'],

            ['id' => 6, 'type' => 'customer', 'title' => 'star_customer'],
            ['id' => 7, 'type' => 'customer', 'title' => 'general_customer'],

            ['id' => 8, 'type' => 'vendor', 'title' => 'standard_vendor'],
            ['id' => 9, 'type' => 'vendor', 'title' => 'limited_vendor'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
