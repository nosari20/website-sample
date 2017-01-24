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
        //$this->call(SocialSeeder::class);
        $this->call(InfoSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(PageSeeder::class);
                                                                                                                                                      
    }
}
