<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrawUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draw_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('draw_id');
            $table->unsignedInteger('amount');
            $table->timestamps();
        });

        Schema::table('draw_users', function($table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('draw_id')->references('id')->on('draw_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('draw_users');
    }
}
