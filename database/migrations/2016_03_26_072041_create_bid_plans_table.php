<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->decimal('increment')->default(0.01);
            $table->timestamp('start');
            $table->timestamp('end');
            $table->unsignedInteger('status')->default(0);
            $table->unsignedInteger('entries')->default(0);
            $table->unsignedInteger('winner_id')->nullable();
            $table->timestamps();
        });

        Schema::table('bid_plans', function($table){
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
        Schema::drop('bid_plans');
    }
}
