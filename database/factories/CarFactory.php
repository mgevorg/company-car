<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\ComfortCategory;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

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
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\FakeCar($faker));
        return [
            'model' => $faker->vehicle(),
            'driver_id' => Employee::factory(),
            'comfort_category_id' => ComfortCategory::factory(),
        ];
    }
}
