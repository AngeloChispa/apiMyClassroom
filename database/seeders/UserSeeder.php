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
        User::create([
            'name' => 'Memo',
            'lastname' => 'Ibarra',
            'email' => 'maestro@correo.com',
            'password' => Hash::make('123Tamarindo'),
            'role_id' => '1'
        ]);

        User::create([
            'name' => 'Claudio',
            'lastname' => 'Gutierrez',
            'email' => 'user@correo.com',
            'password' => Hash::make('123Tamarindo'),
            'role_id' => '2'
        ]);
    }
}
