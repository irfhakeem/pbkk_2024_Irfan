<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\HealthCenter;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalReport>
 */
class MedicalReportFactory extends Factory
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
            'judul' => fake()->words(3, true),
            'patient_id' => fake()->randomElement(Patient::pluck('patient_id')->toArray()),
            'dokter' => fake()->randomElement(Doctor::pluck('nama')->toArray()),
            'faskes' => fake()->randomElement(HealthCenter::pluck('nama')->toArray()),
            'service' => fake()->randomElement(Service::pluck('nama')->toArray()),
            'date' => fake()->date(),
            'status' => fake()->randomElement(['Selesai', 'Belum Selesai']),
            'diagnosis' => fake()->sentence(),
        ];
    }
}
