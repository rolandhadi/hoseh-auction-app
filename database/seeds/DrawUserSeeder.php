<?php

use Illuminate\Database\Seeder;

class DrawUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=1; $i <= 100 ; $i++) {
        DB::table('draw_users')->insert([
          'user_id' => rand(1,10),
          'draw_id' => rand(1,12),
          'amount' => 1
        ]);
      }
    }
}
