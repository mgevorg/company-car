<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\ComfortCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = Employee::where('position_id', '!=', 5)->get();
        $categories = ComfortCategory::all();

        foreach ($drivers as $driver) {
            Car::factory()->create([
                'driver_id' => $driver->id,
                'comfort_category_id' => $categories->random()->id,
            ]);
        }
    }
}
