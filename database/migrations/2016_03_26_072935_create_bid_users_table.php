<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_users', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('user_id');
          $table->unsignedInteger('bid_id');
          $table->unsignedInteger('amount');
          $table->timestamps();
      });

      Schema::table('bid_users', function($table){
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('bid_id')->references('id')->on('bid_plans');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bid_users');
    }
}
