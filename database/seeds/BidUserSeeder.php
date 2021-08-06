<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BidUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=1; $i <= 100 ; $i++) {
        DB::table('bid_users')->insert([
          'user_id' => rand(1,10),
          'bid_id' => rand(1,12),
          'amount' => 1,
          'created_at' => Carbon::now()->addSeconds(rand(1,100)),
          'updated_at' => Carbon::now()->addSeconds(rand(1,100)),
        ]);
      }
    }
}
