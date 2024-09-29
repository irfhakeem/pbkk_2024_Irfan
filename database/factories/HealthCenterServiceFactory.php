<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\HealthCenter;
use \App\Models\Service;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HealthCenterService>
 */
class HealthCenterServiceFactory extends Factory
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
            'health_center_id' => HealthCenter::pluck('health_center_id')->toArray(),
            'service_id' => Service::pluck('service_id')->toArray(),
        ];
    }
}
