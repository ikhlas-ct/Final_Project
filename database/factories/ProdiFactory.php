<?php

namespace Database\Factories;

use App\Models\Kaprodi;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class ProdiFactory extends Factory
{
    protected $model = Kaprodi::class;

    public function definition()
    {
        $user = User::factory()->create(['role' => 'kaprodi']);

        return [
            'user_id' => $user->id,
                'nidn' => $this->faker->numerify('##########'), // Misalnya menggunakan faker untuk NIDN
                'gambar' => 'https://via.placeholder.com/200x200.png', // Ganti dengan gambar profil yang sesuai
                'departemen' => $this->faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro']),
                'no_hp' => $this->faker->phoneNumber,
                'alamat' => $this->faker->address,
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
}
