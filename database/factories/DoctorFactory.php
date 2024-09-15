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
            'no_hp' => $this->generatePhoneNumber(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'spesialis_id' => fake()->randomElement(Specialization::pluck('spesialis_id')->toArray()),
            'tanggal_lahir' => fake()->date(),
            'health_center_id' => fake()->randomElement(HealthCenter::pluck('health_center_id')->toArray()),
        ];
    }

    private function generatePhoneNumber()
    {
        $prefix = '08';
        $length = 12 - strlen($prefix);
        $number = $prefix . $this->faker->numerify(str_repeat('#', $length));
        return $number;
    }
}
