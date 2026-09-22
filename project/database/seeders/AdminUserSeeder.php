<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds the dedicated admin user for administrative login.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@hariomcomputer.com'],
            [
                'name' => 'Hari Om Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
