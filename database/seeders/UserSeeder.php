<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'username' => 'kaprodi',
                'password' => Hash::make('password'),
                'role' => 'kaprodi',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'dosen',
                'password' => Hash::make('password'),
                'role' => 'dosen',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'mahasiswa',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'dosen1',
                'password' => Hash::make('password'),
                'role' => 'dosen',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'dosen2',
                'password' => Hash::make('password'),
                'role' => 'dosen',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'dosen3',
                'password' => Hash::make('password'),
                'role' => 'dosen',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'dosen4',
                'password' => Hash::make('password'),
                'role' => 'dosen',
                'remember_token' => Str::random(10),
            ],
            [
                'username' => 'dosen5',
                'password' => Hash::make('password'),
                'role' => 'dosen',
                'remember_token' => Str::random(10),
            ]
        ]);
    }
}
