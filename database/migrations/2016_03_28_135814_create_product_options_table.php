<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('product_options', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('product_id');
        $table->string('option',255);
      });

      Schema::table('product_options', function($table){
          $table->foreign('product_id')->references('id')->on('products');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_options');
    }
}
