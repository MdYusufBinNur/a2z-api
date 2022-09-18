<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('createdByUserId')->unsigned()->nullable();
            $table->integer('categoryId')->unsigned()->nullable();
            $table->string('sourceOfIncome');
            $table->float('amount');
            $table->text('notes')->nullable();
            $table->date('incomeDate');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoryId')
                ->references('id')->on('income_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('incomes');
    }
}
