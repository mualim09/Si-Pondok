<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Akademik\Konseling>
 */
class KonselingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'santri_id' => $this->faker->numberBetween(1, 500),
            'tanggal' => $this->faker->date(),
            'kasus' => $this->faker->text(),
            'layanan' => $this->faker->text(),
            'dibuat_oleh' => 1,
        ];
    }
}
