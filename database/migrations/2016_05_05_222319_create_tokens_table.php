<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('index');
            $table->unsignedInteger('count');
            $table->unsignedInteger('price');
            $table->timestamps();
        });

        DB::table('tokens')->insert([
          'index' => 1,
          'count' => 25,
          'price' => 18
        ]);
        DB::table('tokens')->insert([
          'index' => 2,
          'count' => 50,
          'price' => 36
        ]);
        DB::table('tokens')->insert([
          'index' => 3,
          'count' => 100,
          'price' => 71
        ]);
        DB::table('tokens')->insert([
          'index' => 4,
          'count' => 300,
          'price' => 210
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tokens');
    }
}
