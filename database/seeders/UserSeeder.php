<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [ 
                'fullname' => 'Super Admin',
                'type' => 'superadmin',
                'username' => 'superadmin',
                'name' => 'Yoga P79'
            ],
        ];


        foreach ($users as $i => $user) {
            $u = User::factory()->create([
                // 'username' => $user['username'],
                'username' => $user['username'],
                'name' => $user['name'],
                'fullname' => $user['fullname'],
                'email' => $user['username']. '@pelamar.com',
                'type' => $user['type'],
            ]);
        }
    }
}
