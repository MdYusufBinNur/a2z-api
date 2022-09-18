<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notification_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('createdByUserId')->unsigned()->nullable();

            $table->foreign('createdByUserId')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });


        DB::table('user_notification_types')->insert([
            ['id' => 1, 'type' => 'generic'],
            ['id' => 2, 'type' => 'daily_digest'],
            ['id' => 3, 'type' => 'message'],
            ['id' => 4, 'type' => 'reminder'],
            ['id' => 5, 'type' => 'announcement'],
            ['id' => 6, 'type' => 'offer'],
            ['id' => 7, 'type' => 'upgrade'],
            ['id' => 8, 'type' => 'order_request'],
            ['id' => 9, 'type' => 'order_accepted'],
            ['id' => 10, 'type' => 'order_pending'],
            ['id' => 11, 'type' => 'order_confirmed'],
            ['id' => 12, 'type' => 'order_processing'],
            ['id' => 13, 'type' => 'order_completed'],
            ['id' => 14, 'type' => 'order_picked'],
            ['id' => 15, 'type' => 'order_shipped'],
            ['id' => 16, 'type' => 'order_delivered'],
            ['id' => 17, 'type' => 'order_cancelled'],
            ['id' => 18, 'type' => 'payment_item_created'],
            ['id' => 19, 'type' => 'payment_item_updated'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notification_types');
    }
}
