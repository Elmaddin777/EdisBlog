<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as db;
use Illuminate\Support\Str as str;

class CategorySeeder extends Seeder
{
  
    public function run()
    {
        $categories = ['General', 'Life', 'Education', 'Tech', 'Places', 'Sport', 'Life Hacks'];
        foreach ($categories as $category) {
          db::table('categories')->insert([
            'name' => $category,
            'slug' => str::slug($category)
          ]);
        }
    }
}
