<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Operator',
            'email' => 'operator@email.com',
            'password' => Hash::make('operator12345'),
            'role' => 'operator',
        ]);

        User::create([
            'name' => 'Kepala Gudang',
            'email' => 'kepalagudang@email.com',
            'password' => Hash::make('kepalagudang12345'),
            'role' => 'kepala_gudang',
        ]);
    }
}