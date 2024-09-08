<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Specialization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specialization>
 */
class SpecializationFactory extends Factory
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
            'spesialisasi' => fake()->unique()->randomElement([
                'Dokter Umum',
                'Dokter Gigi',
                'Spesialis Anak',
                'Spesialis Kandungan',
                'Spesialis Jantung',
                'Spesialis Mata',
                'Spesialis Kulit',
                'Spesialis Bedah',
                'Spesialis THT',
                'Spesialis Kulit dan Kelamin',
                'Spesialis Orthopedi',
                'Spesialis Saraf',
                'Spesialis Penyakit Dalam',
                'Spesialis Paru',
                'Spesialis Gizi',
                'Spesialis Psikologi',
                'Spesialis Rehabilitasi Medik',
                'Spesialis Radiologi',
                'Spesialis Patologi Anatomi',
                'Spesialis Patologi Klinik',
                'Spesialis Forensik',
                'Spesialis Kedokteran Jiwa',
                'Spesialis Mata',
                'Spesialis Tulang'
            ]),
        ];
    }
}
