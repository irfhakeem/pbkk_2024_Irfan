<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Drug;
use App\Models\HealthCenter;
use App\Models\MedicalReport;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Service;
use App\Models\Specialization;
use App\Models\HealthCenterService;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Patient::factory(100)->create();
        HealthCenter::factory(10)->create();
        Specialization::factory(20)->create();
        Doctor::factory(20)->create();
        Drug::factory(15)->create();
        Service::factory(11)->create();
        Prescription::factory(10)->create();
        HealthCenterService::factory(15)->create();
        MedicalReport::factory(10)->create();
        Appointment::factory(10)->create();
    }
}
