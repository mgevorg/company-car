<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => null,
            'car_id' => null,
            'start_time' => $this->faker->dateTimeBetween('+1 days', '+5 days')->format('Y-m-d H:i:s'),
            'end_time' => $this->faker->dateTimeBetween('+6 days', '+10 days')->format('Y-m-d H:i:s'),
        ];
    }
}
