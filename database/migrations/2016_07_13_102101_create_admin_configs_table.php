<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('register_tokens')->default(10);
            $table->unsignedInteger('refer_tokens')->default(10);
            $table->string('paypal_paypal_client_id',255);
            $table->string('paypal_secret',255);
            $table->string('paypal_mode',255)->default('sandbox');
            $table->string('paypal_end_point',255)->default('https://api.sandbox.paypal.com');
            $table->string('sms_user_name',255)->default('');
            $table->string('sms_user_password',255)->default('');
            $table->timestamps();
        });

        DB::table('admin_configs')->insert([
          'register_tokens' => '10',
          'refer_tokens' => '10',
          'paypal_paypal_client_id' => '',
          'paypal_secret' => '',
          'paypal_mode' => 'sandbox',
          'paypal_end_point' => 'https://api.sandbox.paypal.com',
          'sms_user_name' => 'hoseh.com',
          'sms_user_password' => ''
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_configs');
    }
}
