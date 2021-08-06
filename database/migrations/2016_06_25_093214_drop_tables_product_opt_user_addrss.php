<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTablesProductOptUserAddrss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('product_options');
        Schema::drop('user_addresses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::create('product_options', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('product_id');
        $table->string('option',255);
      });

      Schema::table('product_options', function($table){
          $table->foreign('product_id')->references('id')->on('products');
      });

      Schema::create('user_addresses', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('user_id');
          $table->string('address_1',255);
          $table->string('address_2',255);
          $table->string('postal_code',255);
          $table->unsignedInteger('default');
          $table->timestamps();
      });

      Schema::table('user_addresses', function($table){
          $table->foreign('user_id')->references('id')->on('users');
      });
    }
}
