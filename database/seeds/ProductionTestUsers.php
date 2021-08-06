<?php

use Illuminate\Database\Seeder;

class ProductionTestUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $test_users = ['thunderingevaporating',
        'bankerlegal',
        'oilystanhope',
        'diagramsspirketting',
        'cabbagechromate',
        'jabneanderthal',
        'tartlettekilmory',
        'pipitcevian',
        'extractswilliam',
        'sharpmotley',
        'spewduchess',
        'cottagehonored',
        'italicjson',
        'latigoadaptable',
        'dynamicscrubbing',
        'girthcreams',
        'greaseimpetuous',
        'victorymariah',
        'teachercitation',
        'dawlishbanana',
        'wrinklesanalogue',
        'beebeesculling',
        'lambsupercooled',
        'musteringdominator',
        'churchczar',
        'walterscrape',
        'mckenziedoes',
        'mollymarten',
        'beachfried',
        'vocabularyclosing',
        'rustyace',
        'sleepeyeballs',
        'soccermagnet',
        'atheistsquare',
        'shilohtony',
        'volleypicasso',
        'vhsbossy',
        'phaseweanling',
        'paradigmcinch',
        'screenshotpampers',
        'underagecollagen',
        'pincerspoaka',
        'kipperneuron',
        'farawaydetermined',
        'thameslug',
        'emralunwashed',
        'fissioncutting',
        'ribotshoulders',
        'platonicshotput',
        'pumlumonsaskatchewan'
      ];
      foreach ($test_users as $key => $user) {
        $u1 = DB::table('users')->insertGetId([
          'nick_name' => substr($user, 10),
          'first_name' => $user,
          'last_name' => $user,
          'gender' => rand(0,1),
          'email' => $user . '@testing12345.com',
          'mobile' => $key,
          'password' => bcrypt('testing12345'),
          'tokens' => 10,
          'enabled' => '1',
          'birthday' => '1985-01-01 00:00:00',
          'verification_code' => $key
        ]);
      }
    }
}
