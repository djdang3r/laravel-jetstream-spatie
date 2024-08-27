<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name' => 'Root',
                'email' => 'root@scriptdevelop.co',
                'password' => 'password',
                'role' => 'root',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@scriptdevelop.co',
                'password' => 'password',
                'role' => 'admin',
            ]
        ];

        $go = true;

        foreach($users as $user){
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            do {
                $team = $created_user->teams()->create([
                    'name' => 'System Team',
                    'user_id' => $created_user->id,
                    'personal_team' => 1
                ]);
                $go = false;
             }while ($go);

            $created_user->assignRole($user['role']);
        }
    }
}



