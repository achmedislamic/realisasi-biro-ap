<?php

namespace Database\Factories;

use App\Models\RincianMasalah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RincianMasalah>
 */
class RincianMasalahFactory extends Factory
{
    protected $model = RincianMasalah::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tahun' => 2023,
            'sub_opd_id' => fake()->numberBetween(1, 140),
            'sub_kegiatan_id' => fake()->numberBetween(1, 912),
            'triwulan' => fake()->numberBetween(0, 4),
            'kendala' => fake()->city(),
            'tindak_lanjut' => fake()->country(),
            'pihak' => fake()->name(),
        ];
    }
}
