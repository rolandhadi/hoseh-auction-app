<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductionDrawPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $d_id_01 = DB::table('draw_plans')->insertGetId([
        'product_id' => 1,
        'start' => Carbon::now()->addHours(2),
        'end' => Carbon::now()->addHours(2),
        'status' => 1
      ]);
      $d_id_02 = DB::table('draw_plans')->insertGetId([
        'product_id' => 2,
        'start' => Carbon::now()->addHours(4),
        'end' => Carbon::now()->addHours(4),
        'status' => 1
      ]);
      $d_id_03 = DB::table('draw_plans')->insertGetId([
        'product_id' => 3,
        'start' => Carbon::now()->addHours(6),
        'end' => Carbon::now()->addHours(6),
        'status' => 1
      ]);
      $d_id_04 = DB::table('draw_plans')->insertGetId([
        'product_id' => 4,
        'start' => Carbon::now()->addHours(8),
        'end' => Carbon::now()->addHours(8),
        'status' => 1
      ]);
      $d_id_05 = DB::table('draw_plans')->insertGetId([
        'product_id' => 5,
        'start' => Carbon::now()->addHours(10),
        'end' => Carbon::now()->addHours(10),
        'status' => 1
      ]);
      $d_id_06 = DB::table('draw_plans')->insertGetId([
        'product_id' => 6,
        'start' => Carbon::now()->addHours(12),
        'end' => Carbon::now()->addHours(12),
        'status' => 1
      ]);
      $d_id_07 = DB::table('draw_plans')->insertGetId([
        'product_id' => 7,
        'start' => Carbon::now()->addHours(14),
        'end' => Carbon::now()->addHours(14),
        'status' => 1
      ]);
      $d_id_08 = DB::table('draw_plans')->insertGetId([
        'product_id' => 8,
        'start' => Carbon::now()->addHours(16),
        'end' => Carbon::now()->addHours(16),
        'status' => 1
      ]);
      $d_id_09 = DB::table('draw_plans')->insertGetId([
        'product_id' => 9,
        'start' => Carbon::now()->addHours(18),
        'end' => Carbon::now()->addHours(18),
        'status' => 1
      ]);
      $d_id_10 = DB::table('draw_plans')->insertGetId([
        'product_id' => 10,
        'start' => Carbon::now()->addHours(20),
        'end' => Carbon::now()->addHours(20),
        'status' => 1
      ]);
      $d_id_11 = DB::table('draw_plans')->insertGetId([
        'product_id' => 11,
        'start' => Carbon::now()->addHours(22),
        'end' => Carbon::now()->addHours(22),
        'status' => 1
      ]);
      $d_id_12 = DB::table('draw_plans')->insertGetId([
        'product_id' => 12,
        'start' => Carbon::now()->addHours(24),
        'end' => Carbon::now()->addHours(24),
        'status' => 1
      ]);
    }
}
