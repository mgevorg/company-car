<?php

namespace Database\Factories;

use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory>
 */
class ComfortCategoryFactory extends Factory
{
    protected $model = ComfortCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['First', 'Second', 'Third']),
        ];
    }
}
