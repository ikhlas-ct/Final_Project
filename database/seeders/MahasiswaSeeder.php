<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;


class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::insert([
            [
                'user_id' => 3,
                'fakultas_id' => 1,
                'nama' => 'Jane Doe',
                'nim' => '2020123456',
                'no_hp' => '081234567891',
                'poto' => 'path/to/photo.jpg',
            ],
        ]);
    }
}
