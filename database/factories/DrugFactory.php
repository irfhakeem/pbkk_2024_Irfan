<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drug>
 */
class DrugFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->word(),
            'jenis' => fake()->randomElement(['Tablet', 'Kapsul', 'Cair', 'Salep']),
            'satuan' => fake()->randomElement(['mg', 'ml', 'gram']),
        ];
    }
}
