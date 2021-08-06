<?php

use Illuminate\Database\Seeder;

class ProductionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users_total = 4;
      for ($i=1; $i < $users_total; $i++) {
        $u1 = DB::table('users')->insertGetId([
          'nick_name' => 'user_' . $i,
          'first_name' => 'first_' . $i,
          'last_name' => 'last_' . $i,
          'gender' => rand(0,1),
          'email' => 'test.0' . $i . '@gmail.com',
          'mobile' => $i,
          'password' => bcrypt('password@123'),
          'tokens' => 10,
          'enabled' => '1',
          'verification_code' => $i
        ]);
      }
    }
}
