<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HealthCenter;
use App\Models\Service;
use App\Models\HealthCenterService;

class HealthCenterServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $healthCenters = HealthCenter::select('health_center_id')->get();

        $allServiceIds = Service::pluck('service_id')->toArray();

        foreach ($healthCenters as $healthCenter) {
            if (count($allServiceIds) < 5) {
                $this->command->error('Jumlah service kurang dari 5, tambahkan lebih banyak service.');
                return;
            }

            $randomServiceIds = fake()->randomElements($allServiceIds, 5);

            foreach ($randomServiceIds as $serviceId) {
                HealthCenterService::create([
                    'health_center_id' => $healthCenter->health_center_id,
                    'service_id' => $serviceId,
                ]);
            }
        }
    }
}
