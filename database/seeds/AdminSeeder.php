<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
           db::table('admins')->insert([
             'name' => 'edi', 
             'mail' => 'edi@gmail.com', 
             'password' => bcrypt('111')
           ]);
     }
}
