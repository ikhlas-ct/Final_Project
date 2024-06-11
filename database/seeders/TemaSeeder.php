<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tema;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tema::create([
            'fakultas_id' => 1,
            'nama' => 'Sistem Pakar',
        ]);
        Tema::create([
            'fakultas_id' => 1,
            'nama' => 'Machine Learning',
        ]);
        Tema::create([
            'fakultas_id' => 2,
            'nama' => 'Artificial Intelligence',
        ]);
        Tema::create([
            'fakultas_id' => 2,
            'nama' => 'Data Science',
        ]);
    }
}
