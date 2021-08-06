<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrawPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draw_purchases', function (Blueprint $table) {
          $table->increments('id');
          $table->string('invoice_id',255);
          $table->unsignedInteger('user_id');
          $table->unsignedInteger('draw_id');
          $table->unsignedInteger('entries')->default(0);
          $table->decimal('price')->default(0);
          $table->timestamps();
        });

        Schema::table('draw_purchases', function($table){
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
        Schema::drop('draw_purchases');
    }
}
