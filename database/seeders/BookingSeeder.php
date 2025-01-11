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
        $employees = Employee::all()->skip(5);
        $cars = Car::all();

        foreach ($employees as $employee) {
            Booking::factory()->count(2)->create([
                'employee_id' => $employee->id,
                'car_id' => $cars->random()->id,
                'start_time' => now()->addDays(rand(1, 5))->format('Y-m-d H:i:s'),
                'end_time' => now()->addDays(rand(6, 10))->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
