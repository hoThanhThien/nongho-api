<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ThuaDat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CayTrong>
 */
class CayTrongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ten_cay' => $this->faker->randomElement(['Lúa', 'Ngô', 'Khoai lang', 'Đậu xanh', 'Cà chua']),
            'giong' => $this->faker->randomElement(['IR64', 'OM380', 'ST25', 'Jasmine', 'Híp Dragon']),
            'thuadat_id' => ThuaDat::factory(),
        ];
    }
}
