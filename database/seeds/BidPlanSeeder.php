<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BidPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $b_id_01 = DB::table('bid_plans')->insertGetId([
        'product_id' => 1,
        'start' => Carbon::now()->addMinutes(2),
        'end' => Carbon::now()->addMinutes(2),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_02 = DB::table('bid_plans')->insertGetId([
        'product_id' => 2,
        'start' => Carbon::now()->addMinutes(4),
        'end' => Carbon::now()->addMinutes(4),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_03 = DB::table('bid_plans')->insertGetId([
        'product_id' => 3,
        'start' => Carbon::now()->addMinutes(6),
        'end' => Carbon::now()->addMinutes(6),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_04 = DB::table('bid_plans')->insertGetId([
        'product_id' => 4,
        'start' => Carbon::now()->addMinutes(8),
        'end' => Carbon::now()->addMinutes(8),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_05 = DB::table('bid_plans')->insertGetId([
        'product_id' => 5,
        'start' => Carbon::now()->addMinutes(10),
        'end' => Carbon::now()->addMinutes(10),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_06 = DB::table('bid_plans')->insertGetId([
        'product_id' => 6,
        'start' => Carbon::now()->addMinutes(12),
        'end' => Carbon::now()->addMinutes(12),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_07 = DB::table('bid_plans')->insertGetId([
        'product_id' => 7,
        'start' => Carbon::now()->addMinutes(14),
        'end' => Carbon::now()->addMinutes(14),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_08 = DB::table('bid_plans')->insertGetId([
        'product_id' => 8,
        'start' => Carbon::now()->addMinutes(16),
        'end' => Carbon::now()->addMinutes(16),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_09 = DB::table('bid_plans')->insertGetId([
        'product_id' => 9,
        'start' => Carbon::now()->addMinutes(18),
        'end' => Carbon::now()->addMinutes(18),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_10 = DB::table('bid_plans')->insertGetId([
        'product_id' => 10,
        'start' => Carbon::now()->addMinutes(20),
        'end' => Carbon::now()->addMinutes(20),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_11 = DB::table('bid_plans')->insertGetId([
        'product_id' => 11,
        'start' => Carbon::now()->addMinutes(22),
        'end' => Carbon::now()->addMinutes(22),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
      $b_id_12 = DB::table('bid_plans')->insertGetId([
        'product_id' => 12,
        'start' => Carbon::now()->addMinutes(24),
        'end' => Carbon::now()->addMinutes(24),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'status' => 1
      ]);
    }
}
