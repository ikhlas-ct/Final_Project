<?php

namespace Database\Seeders;

use App\Models\Dosen;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil seeder yang telah dibuat
        $this->call([
            UserSeeder::class,
            FakultasSeeder::class,
            KaprodiSeeder::class,
            DosenSeeder::class,
            // MahasiswaSeeder::class,
            TemaSeeder::class,
            AdminSeeder::class
        ]);
    }
}
