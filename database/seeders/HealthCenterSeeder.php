<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class HealthCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch data dari API
        $response = Http::get('https://dekontaminasi.com/api/id/covid19/hospitals');

        // Pastikan response berhasil
        if ($response->successful()) {
            $hospitals = $response->json();

            // Loop melalui data yang di-fetch dan insert ke database
            foreach ($hospitals as $hospital) {
                DB::table('health_centers')->insert([
                    'name' => $hospital['name'],
                    'address' => $hospital['address'],
                    'region' => $hospital['region'],
                    'phone' => $hospital['phone'],
                    'province' => $hospital['province'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            // Handle error response dari API jika ada
            $this->command->error('Failed to fetch data from API');
        }
    }
}
