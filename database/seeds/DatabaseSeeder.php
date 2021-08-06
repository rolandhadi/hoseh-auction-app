<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(env('APP_ENV','production') == 'production'){
        // $this->call(ProductionUserSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(ProductionDrawPlanSeeder::class);
        // $this->call(ProductionBidPlanSeeder::class);
      }
      else {
        // $this->call(UserTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(DrawPlanSeeder::class);
        // $this->call(DrawUserSeeder::class);
        // $this->call(BidPlanSeeder::class);
        // $this->call(BidUserSeeder::class);
      }
    }
}
