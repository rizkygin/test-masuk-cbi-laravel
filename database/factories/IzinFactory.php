<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Izin>
 */
class IzinFactory extends Factory
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
            'tanggal' => fake()->date,
            'keterangan' => fake()->realText(100),
            'alasan' => fake()->randomElement(['izin', 'sakit', 'cuti']),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}