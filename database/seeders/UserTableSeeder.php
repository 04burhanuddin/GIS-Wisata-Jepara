<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            [
                'id' => '1',
                'name' => 'Burhan',
                'email' => 'dev.burhanuddin@gmail.com',
                'password' => bcrypt('Admin123'),
                'remember_token' => NULL,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'id' => '2',
                'name' => 'Makarno',
                'email' => 'arno@gmail.com',
                'password' => bcrypt('Admin123'),
                'remember_token' => NULL,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}