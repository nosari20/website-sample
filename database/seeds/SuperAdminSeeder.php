<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name' => 'admin',
            'email' => env('SUPER_ADMIN_EMAIL', 'admin@'.env('APP_URL')),
            'password' => bcrypt('keepitsecret'),
            'role' => 'super',
        ]);
    }
}
