<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->string('country')->nullable();
            
            $table->binary('company_logo')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('event_rep1')->nullable();
            $table->string('event_rep2')->nullable();
            $table->string('designation')->nullable();
            $table->string('products')->nullable();
            $table->string('website')->nullable();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('sellers');
    }
}
