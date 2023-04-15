<?php

namespace Database\Factories;

use App\Models\ObjekRealisasi;
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
            'objek_realisasi_id' => ObjekRealisasi::select('id')->where('anggaran', '!=', 0)->inRandomOrder()->first()->id,
            'tanggal' => fake()->unique()->dateTimeBetween(now()->addYear(1)->startOfYear(), now()->addYear(1)->endOfYear()),
            'jumlah' => fake()->numberBetween(1000,9999),
        ];
    }
}
