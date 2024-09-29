<?php

namespace Database\Seeders;

use App\Models\Prescription;
use App\Models\PrescriptionDrug;
use App\Models\Drug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrescriptionDrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $prescriptions = Prescription::select('prescription_id')->get();

        // Ambil semua layanan
        $allDrugIds = Drug::pluck('drug_id')->toArray();

        foreach ($prescriptions as $prescription) {
            if (count($allDrugIds) < 5) {
                $this->command->error('Jumlah service kurang dari 5, tambahkan lebih banyak service.');
                return;
            }

            $randomDrugIds = fake()->randomElements($allDrugIds, 5);

            foreach ($randomDrugIds as $drugId) {
                PrescriptionDrug::create([
                    'prescription_id' => $prescription->prescription_id,
                    'drug_id' => $drugId,
                ]);
            }
        }
    }
}
