<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $dosen = [
            [
                'user_id' => 2,
                'fakultas_id' => 1,
                'nidn' => '1234567890',
                'nama' => 'Ahmad Sudirman M.kom',
                'no_hp' => '0812345678901',
                'poto' => 'path/to/photo1.jpg',
            ],
            [
                'user_id' => 3,
                'fakultas_id' => 1,
                'nidn' => '12345678902',
                'nama' => 'Cahya Wibawa M.kom',
                'no_hp' => '081234567890',
                'poto' => 'path/to/photo1.jpg',
            ],
            [
                'user_id' => 4,
                'fakultas_id' => 1,
                'nidn' => '12345678903',
                'nama' => 'Dewi Anggraeni M.kom',
                'no_hp' => '081234567890',
                'poto' => 'path/to/photo1.jpg',
            ],
            [
                'user_id' => 5,
                'fakultas_id' => 1,
                'nidn' => '12345678904',
                'nama' => 'Eka Putri M.kom',
                'no_hp' => '081234567890',
                'poto' => 'path/to/photo1.jpg',
            ],
            [
                'user_id' => 11,
                'fakultas_id' => 2,
                'nidn' => '12345678907',
                'nama' => 'Supriyadi SH',
                'no_hp' => '081234567890',
                'poto' => 'path/to/photo1.jpg',
            ]
        ];

        Dosen::insert($dosen);
    }
}
