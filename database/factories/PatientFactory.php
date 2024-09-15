<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nik' => fake()->unique()->randomNumber(8, true),
            'tanggal_lahir' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => $this->generatePhoneNumber(),
            'Golongan_darah' => fake()->randomElement(['A', 'B', 'AB', 'O']),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
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
