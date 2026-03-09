<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absen>
 */
class AbsenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'karyawan_id' => fake()->numberBetween(1, 100),
            'tanggal' => fake()->date(),
            'jam_masuk' => fake()->time(),
            'jam_pulang' => fake()->time(),
            'status' => fake()->randomElement(['Masuk', 'Izin', 'Sakit', 'Alpa']),
        ];
    }
}