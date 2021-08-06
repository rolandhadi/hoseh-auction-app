<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDrawPlanTableAddPlannedWinnerIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('draw_plans', function (Blueprint $table) {
          $table->unsignedInteger('planned_winner_id')->nullable()->after('winner_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('draw_plans', function (Blueprint $table) {
          $table->dropColumn('planned_winner_id');
      });
    }
}
