<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('country')->nullable();

            $table->binary('company_logo')->nullable();
            $table->string('company_name');
            $table->string('company_address');
            $table->string('event_rep1');
            $table->string('event_rep2');
            $table->string('designation');
            $table->string('website');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('buyers');
    }
}
