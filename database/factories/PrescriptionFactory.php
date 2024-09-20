<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'penyakit' => fake()->sentence(),
            'instruksi' => fake()->sentence(),
            'dokter' => fake()->randomElement(Doctor::pluck('nama')->toArray()),
            'patient_id' => fake()->randomElement(Patient::pluck('patient_id')->toArray()),
        ];
    }
}
