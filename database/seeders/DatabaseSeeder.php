<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Customer Satu',
            'email' => 'customer1@example.com',
            'password' => Hash::make('customer1'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Customer Dua',
            'email' => 'customer2@example.com',
            'password' => Hash::make('customer2'),
            'role' => 'customer',
        ]);
    }
}
