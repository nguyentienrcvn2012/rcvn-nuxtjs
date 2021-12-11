<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            ['id' => 1, 'name' => 'dev.test01', 'email' => 'dev.test01@gmail.com', 'phone' => 0123421233,'address' =>'Quận 10', 'post_id' => 1],
            ['id' => 2, 'name' => 'dev.test02', 'email' => 'dev.test02@gmail.com', 'phone' => 0123421233,'address' =>'Quận 111', 'post_id' => 2],
            ['id' => 3, 'name' => 'dev.test03', 'email' => 'dev.test03@gmail.com', 'phone' => 01234212331,'address' =>'Quận 12', 'post_id' => 3],
            ['id' => 4, 'name' => 'dev.test04', 'email' => 'dev.test04@gmail.com', 'phone' => 10123421233,'address' =>'Quận 1', 'post_id' => 4],
            ['id' => 5, 'name' => 'dev.test05', 'email' => 'dev.test05@gmail.com', 'phone' => 01234212331,'address' =>'Quận 4', 'post_id' => 5],
            ['id' => 6, 'name' => 'dev.test06', 'email' => 'dev.test06@gmail.com', 'phone' => 10123421233,'address' =>'Quận 4', 'post_id' => 6],
         ]);
    }
}
