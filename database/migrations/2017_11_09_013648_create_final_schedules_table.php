<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateFinalSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->nullable();
            $table->integer('buyer_id')->unsigned()->nullable();
            $table->integer('seller_id')->unsigned()->nullable();
            $table->integer('event_param_id')->unsigned()->nullable();
            $table->integer('table')->unsigned()->nullable();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('event_param_id')->references('id')->on('event_params')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('final_schedules');
    }
}
