<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBidDrawPurchasesTableAddStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('bid_purchases', function (Blueprint $table) {
         $table->unsignedInteger('status')->default(3)->after('desc');
       });
       Schema::table('draw_purchases', function (Blueprint $table) {
         $table->unsignedInteger('status')->default(3)->after('desc');
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('bid_purchases', function (Blueprint $table) {
           $table->dropColumn('status');
       });
       Schema::table('draw_purchases', function (Blueprint $table) {
           $table->dropColumn('status');
       });
     }
}
