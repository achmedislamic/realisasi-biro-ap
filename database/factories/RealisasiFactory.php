<?php

namespace Database\Factories;

use App\Models\Realisasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Realisasi>
 */
class RealisasiFactory extends Factory
{
    protected $model = Realisasi::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'objek_realisasi_id' => fake()->numberBetween(1,5800),
            'tanggal' => fake()->unique()->dateTimeBetween(now()->addYear(1)->startOfYear(), now()->addYear(1)->endOfYear()),
            'jumlah' => fake()->numberBetween(1000,9999),
        ];
    }
}
