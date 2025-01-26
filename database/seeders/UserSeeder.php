<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Admin',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'User1',
            'password' => Hash::make('userpassword1'),
        ]);

        User::create([
            'name' => 'User2',
            'password' => Hash::make('userpassword2'),
        ]);
    }
}
