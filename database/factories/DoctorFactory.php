<?php

namespace Database\Factories;

use App\Models\Specialization;
use App\Models\HealthCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sip' => fake()->unique()->randomNumber(9, true),
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => fake()->phoneNumber(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'spesialis_id' => Specialization::factory(),
            'tanggal_lahir' => fake()->date(),
            'health_center_id' => HealthCenter::factory(),
        ];
    }
}
