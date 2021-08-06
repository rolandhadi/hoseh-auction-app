<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBidDrawPurchasesTableAddDescColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('bid_purchases', function (Blueprint $table) {
        $table->text('desc')->after('price');
      });
      Schema::table('draw_purchases', function (Blueprint $table) {
        $table->text('desc')->after('price');
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
          $table->dropColumn('desc');
      });
      Schema::table('draw_purchases', function (Blueprint $table) {
          $table->dropColumn('desc');
      });
    }
}
