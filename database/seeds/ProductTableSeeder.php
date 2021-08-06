<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $p_id_01 = DB::table('products')->insertGetId([
        'name' => 'iPhone 6 Plus (16GB)',
        'desc' => 'iPhone 6 Plus (16GB)',
        'price' => 1138,
        'quantity' => 5
      ]);
      $p_id_02 = DB::table('products')->insertGetId([
        'name' => 'HTC Desire 820',
        'desc' => 'HTC Desire 820 Gray-Blue',
        'price' => 1038,
        'quantity' => 5
      ]);
      $p_id_03 = DB::table('products')->insertGetId([
        'name' => '11" MacBook Air 256 GB',
        'desc' => '11-inch MacBook Air 256 GB Storage',
        'price' => 2216.50,
        'quantity' => 5
      ]);
      $p_id_04 = DB::table('products')->insertGetId([
        'name' => 'LG Nexus 5',
        'desc' => 'LG Nexus 5',
        'price' => 1018,
        'quantity' => 5
      ]);
      $p_id_05 = DB::table('products')->insertGetId([
        'name' => 'Headphone Black Edition',
        'desc' => 'Headphone Black Edition (Red/Black)',
        'price' => 500,
        'quantity' => 5
      ]);
      $p_id_06 = DB::table('products')->insertGetId([
        'name' => '32-inch Toshiba LED TV',
        'desc' => '32-inch Toshiba LED TV (32L3450VT)',
        'price' => 600,
        'quantity' => 5
      ]);
      $p_id_07 = DB::table('products')->insertGetId([
        'name' => '21.5" iMac 2.9GHz 1TB',
        'desc' => '21.5" iMac 2.9GHz Processor 1 TB Storage',
        'price' => 72,
        'quantity' => 5
      ]);
      $p_id_08 = DB::table('products')->insertGetId([
        'name' => 'Xperia™ Tablet S (16GB)',
        'desc' => 'Xperia™ Tablet S (16GB)',
        'price' => 810,
        'quantity' => 5
      ]);
      $p_id_09 = DB::table('products')->insertGetId([
        'name' => 'Samsung Galaxy S5',
        'desc' => 'Samsung Galaxy S5',
        'price' => 910,
        'quantity' => 5
      ]);
      $p_id_10 = DB::table('products')->insertGetId([
        'name' => 'Nike Shoes',
        'desc' => 'Nike Shoes Red',
        'price' => 236,
        'quantity' => 5
      ]);
      $p_id_11 = DB::table('products')->insertGetId([
        'name' => 'DELL Ultrabook L321X',
        'desc' => 'DELL Ultrabook XPS L321X',
        'price' => 1800,
        'quantity' => 5
      ]);
      $p_id_12 = DB::table('products')->insertGetId([
        'name' => 'Nikon D5200',
        'desc' => 'Nikon D5200 Digital Camera',
        'price' => 900,
        'quantity' => 5
      ]);

      DB::table('product_images')->insert([
        'product_id' => $p_id_01,
        'img' => $p_id_01 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_02,
        'img' => $p_id_02 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_03,
        'img' => $p_id_03 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_04,
        'img' => $p_id_04 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_05,
        'img' => $p_id_05 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_06,
        'img' => $p_id_06 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_07,
        'img' => $p_id_07 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_08,
        'img' => $p_id_08 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_09,
        'img' => $p_id_09 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_10,
        'img' => $p_id_10 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_11,
        'img' => $p_id_11 . '.jpg'
      ]);
      DB::table('product_images')->insert([
        'product_id' => $p_id_12,
        'img' => $p_id_12 . '.jpg'
      ]);

      DB::table('product_tags')->insert([
        'product_id' => $p_id_01,
        'tag' => $p_id_01 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_02,
        'tag' => $p_id_02 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_03,
        'tag' => $p_id_03 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_04,
        'tag' => $p_id_04 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_05,
        'tag' => $p_id_05 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_06,
        'tag' => $p_id_06 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_07,
        'tag' => $p_id_07 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_08,
        'tag' => $p_id_08 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_09,
        'tag' => $p_id_09 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_10,
        'tag' => $p_id_10 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_11,
        'tag' => $p_id_11 . ' tag'
      ]);
      DB::table('product_tags')->insert([
        'product_id' => $p_id_12,
        'tag' => $p_id_12 . ' tag'
      ]);
    }
}
