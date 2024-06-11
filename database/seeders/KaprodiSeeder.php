<?php

namespace Database\Seeders;

use App\Models\Kaprodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaprodiSeeder extends Seeder
{

    public function run(): void
    {
        Kaprodi::insert([
            [
                'user_id' => 1,
                'fakultas_id' => 1,
                'nama' => 'Dr. John Doe',
                'nidn' => '1234567890',
                'no_hp' => '081234567890',
                'poto' => 'path/to/photo.jpg',
            ],
        ]);
    }
}
