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
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Specialization::class;

    /**
     * Counter to keep track of the current index.
     *
     * @var int
     */
    private static $index = 0;

    /**
     * Array of specializations.
     *
     * @var array
     */
    private static $specializations = [
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
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get the current specialization
        $specialization = self::$specializations[self::$index];

        // Increment the index and reset if it exceeds the array length
        self::$index = (self::$index + 1) % count(self::$specializations);

        return [
            'spesialisasi' => $specialization,
        ];
    }
}
