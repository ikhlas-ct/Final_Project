<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fakultas::create(['nama' => 'Komputer']);
        Fakultas::create(['nama' => 'Hukum']);
        // Tambahkan data lainnya sesuai kebutuhan
    }
}
