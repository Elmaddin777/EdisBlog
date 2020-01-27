<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['About', 'Mission', 'Vision'];
        $count = 0;
      
      
          foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
              'title' =>  $page,
              'image' => 'https://seo-focus.com/wp-content/uploads/2018/10/A-Blog-Isn%E2%80%99t-a-Blog-It%E2%80%99s-a-Business.jpg',
              'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero porro non a natus dolor quam mollitia adipisci reiciendis officiis in cumque, amet inventore minima omnis cum. Inventore, voluptatem optio cum?
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
              'slug' => str_slug($page),
              'order' =>  $count
            ]);
          }
        
    }
}





