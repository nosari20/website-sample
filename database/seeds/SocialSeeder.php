<?php

use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert([
            'name' => 'facebook',
            'icon' => 'fa-facebook',
            'iconType' => 'fa',                        
        ]);

        DB::table('socials')->insert([
            'name' => 'twitter',
            'icon' => 'fa-twitter',
            'iconType' => 'fa',                        
        ]);

        DB::table('socials')->insert([
            'name' => 'google-plus',
            'icon' => 'fa-google-plus',
            'iconType' => 'fa',                        
        ]);

        DB::table('socials')->insert([
            'name' => 'instagram',
            'icon' => 'fa-instagram',
            'iconType' => 'fa',                        
        ]);

        DB::table('socials')->insert([
            'name' => 'tripadvisor',
            'icon' => 'fa-tripadvisor',
            'iconType' => 'fa',                        
        ]);

         DB::table('socials')->insert([
            'name' => 'youtube',
            'icon' => 'fa-youtube',
            'iconType' => 'fa',                        
        ]);
    }
}
