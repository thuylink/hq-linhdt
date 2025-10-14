<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commune>
 */
class CommuneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Commune::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'district_id' => District::inRandomOrder()->first()->id
        ];
    }
}
