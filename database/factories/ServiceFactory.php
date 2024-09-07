<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->unique()->randomElement([
                'Checkup',
                'Laboratory',
                'Pharmacy',
                'Radiology',
                'Emergency',
                'Operation',
                'Physiotherapy',
                'Dental',
                'Optical',
                'Psychiatry',
                'Dermatology',
            ]),
        ];
    }
}
