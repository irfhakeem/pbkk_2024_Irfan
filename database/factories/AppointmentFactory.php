<?php

namespace Database\Factories;

use App\Models\HealthCenter;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
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
            'patient_id' => fake()->randomElement(Patient::pluck('patient_id')->toArray()),
            'doctor_id' => fake()->randomElement(Doctor::pluck('doctor_id')->toArray()),
            'health_center_id' => fake()->randomElement(HealthCenter::pluck('health_center_id')->toArray()),
            'service_id' => fake()->randomElement(Service::pluck('service_id')->toArray()),
            'date' => fake()->date(),
            'time' => fake()->time(),
        ];
    }
}
