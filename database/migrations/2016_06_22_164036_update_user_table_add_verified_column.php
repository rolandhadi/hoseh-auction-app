<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTableAddVerifiedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('users', function (Blueprint $table) {
           $table->unsignedInteger('verified')->default(0)->after('enabled');
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('enabled');
       });
     }
}
