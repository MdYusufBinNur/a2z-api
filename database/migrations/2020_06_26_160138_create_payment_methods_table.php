<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();;
            $table->string('title');
            $table->string('link')->nullable();
            $table->string('callbackUrl')->nullable();
            $table->string('discount')->nullable();
            $table->text('details')->nullable();
            $table->boolean('isActive')->default(false);
            $table->integer('updatedByUserId')->unsigned()->nullable();;
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

        DB::table('payment_methods')->insert(
            ['id' => 1, 'title' => 'Cash'],
            ['id' => 2, 'title' => 'bkash'],
            ['id' => 3, 'title' => 'Nagad'],
            ['id' => 4, 'title' => 'Rocket'],
            ['id' => 5, 'title' => 'Card'],
            ['id' => 6, 'title' => 'Bank'],
            ['id' => 7, 'title' => 'SSLCommerz']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
