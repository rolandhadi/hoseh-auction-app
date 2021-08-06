<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick_name',255);
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->unsignedInteger('gender')->default(1);
            $table->timestamp('birthday');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->text('address');
            $table->unsignedInteger('tokens')->default(0);
            $table->string('password', 60)->default('default_password');
            $table->unsignedInteger('enabled')->default(0);
            $table->unsignedInteger('verification_code')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
          'nick_name' => 'HosehAdmin',
          'first_name' => 'Hoseh',
          'last_name' => 'Admininistrator',
          'gender' => '1',
          'email' => 'hoseh@gmail.com',
          'mobile' => '1111111111',
          'password' => bcrypt('password'),
          'enabled' => '1',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
