<?php
use App\Models\NongHo;
use Illuminate\Database\Eloquent\Factories\Factory;

class NongHoFactory extends Factory
{
    protected $model = NongHo::class;

    public function definition()
    {
        return [
            'ten' => $this->faker->name,
            'dia_chi' => $this->faker->address,
            'so_dien_thoai' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
