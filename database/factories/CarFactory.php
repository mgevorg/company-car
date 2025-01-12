<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\ComfortCategory;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => $this->faker->word(),
            'driver_id' => Employee::factory(),
            'comfort_category_id' => ComfortCategory::factory(),
        ];
    }
}
