<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NongHo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ThuaDat>
 */
class ThuaDatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ten_thua' => $this->faker->randomElement(['Thửa ruộng A', 'Thửa ruộng B', 'Thửa vườn C', 'Thửa đất D']),
            'dien_tich' => $this->faker->randomFloat(2, 1000, 50000), // 1000-50000 m2
            'nongho_id' => NongHo::factory(),
        ];
    }
}
