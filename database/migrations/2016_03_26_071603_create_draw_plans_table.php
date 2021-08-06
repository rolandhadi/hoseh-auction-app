<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrawPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draw_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->unsignedInteger('status')->default(0);
            $table->unsignedInteger('entries')->default(0);
            $table->unsignedInteger('winner_id')->nullable();
            $table->timestamps();
        });

        Schema::table('draw_plans', function($table){
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('winner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('draw_plans');
    }
}
