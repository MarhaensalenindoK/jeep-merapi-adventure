<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin user untuk testing
        User::firstOrCreate(
            ['email' => 'elissuraningsih@gmail.com'],
            [
                'name' => 'Administrator',
                'email' => 'elissuraningsih@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Buat beberapa user untuk testing
        $users = [
            [
                'name' => 'Manager Wisata',
                'email' => 'manager@jeepmerapiadventure.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Staff Operasional',
                'email' => 'staff@jeepmerapiadventure.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Content Creator',
                'email' => 'content@jeepmerapiadventure.com',
                'password' => Hash::make('password'),
            ]
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, ['email_verified_at' => now()])
            );
        }

        $this->command->info('Users created successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('- elissuraningsih@gmail.com / password');
        $this->command->info('- manager@jeepmerapiadventure.com / password');
        $this->command->info('- staff@jeepmerapiadventure.com / password');
        $this->command->info('- content@jeepmerapiadventure.com / password');
    }
}
