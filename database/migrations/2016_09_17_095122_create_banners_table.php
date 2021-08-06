<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('banner_no')->default(1);
            $table->text('filename');
            $table->text('url');
            $table->timestamps();
        });

        DB::table('banners')->insert([
          'banner_no' => '1',
          'filename' => 'main-banner-01.png',
          'url' => '#1'
        ]);
        DB::table('banners')->insert([
          'banner_no' => '2',
          'filename' => 'main-banner-02.png',
          'url' => '#2'
        ]);
        DB::table('banners')->insert([
          'banner_no' => '3',
          'filename' => 'main-banner-03.png',
          'url' => '#3'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banners');
    }
}
