<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin::factory()->count(10)->create();
        $admin = [
            [
                'user_id' => 11,
                'nama' => "Budi Santoso", // Indonesian name
                'gambar' => "TEST",
                'no_hp' => '081234567892',
                'alamat' => "Jl. Merdeka No. 10, Jakarta" // Indonesian address
            ]
        ];
        Admin::insert($admin);
    }
}
