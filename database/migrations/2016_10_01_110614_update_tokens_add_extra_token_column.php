<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTokensAddExtraTokenColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('tokens', function (Blueprint $table) {
        $table->unsignedInteger('extra_tokens')->default(0)->after('count');
      });
      DB::table('tokens')->where('id', 1)->update([
          'extra_tokens' => 0,
      ]);
      DB::table('tokens')->where('id', 2)->update([
          'extra_tokens' => 2,
      ]);
      DB::table('tokens')->where('id', 3)->update([
          'extra_tokens' => 5,
      ]);
      DB::table('tokens')->where('id', 4)->update([
          'extra_tokens' => 10
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('tokens', function (Blueprint $table) {
          $table->dropColumn('extra_tokens');
      });
    }
}
