<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'cvfashion',
            'email' => 'cvfashion@test.com',
            'password' => Hash::make('CvFashion.abcABC123'),
            'is_admin' => 1,
        ]);
    }
}

