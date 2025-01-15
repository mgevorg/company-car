<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::where('position_id', '!=', 5)->get();
        $cars = Car::inRandomOrder()->limit(10)->get();

        foreach ($employees as $employee) {
            $car = $this->findAvailableCar($cars);

            if ($car) {
                $start_time = now()->addDays(rand(1, 5))->setTime(rand(8, 16), 0, 0);
                $end_time = (clone $start_time)->addHours(rand(1, 4));

                Booking::create([
                    'employee_id' => $employee->id,
                    'car_id' => $car->id,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                ]);
            }
        }
    }

    /**
     * Find an available car that is not booked during the generated time range.
     *
     * @param \Illuminate\Support\Collection $cars
     * @return \App\Models\Car|null
     */
    private function findAvailableCar($cars): mixed
    {
        foreach ($cars as $car) {
            $start_time = now()->addDays(rand(1, 5))->setTime(rand(8, 16), 0, 0);
            $end_time = (clone $start_time)->addHours(rand(1, 4));

            $overlapExists = Booking::where('car_id', $car->id)
                ->where(function ($query) use ($start_time, $end_time) {
                    $query->whereBetween('start_time', [$start_time, $end_time])
                        ->orWhereBetween('end_time', [$start_time, $end_time])
                        ->orWhere(function ($query) use ($start_time, $end_time) {
                            $query->where('start_time', '<=', $start_time)
                                ->where('end_time', '>=', $end_time);
                        });
                })
                ->exists();

            if (!$overlapExists) {
                return $car;
            }
        }

        return null; // No available car
    }
}
