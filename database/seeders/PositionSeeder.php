<?php

namespace Database\Seeders;

use App\Models\ComfortCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::factory()->create(
            ['name' => 'Director'],
        );
        Position::factory()->create(
            ['name' => 'Manager'],
        );
        Position::factory()->create(
            ['name' => 'TeamLeader'],
        );
        Position::factory()->create(
            ['name' => 'RegularEmployee'],
        );
        Position::factory()->create(
            ['name' => 'DriverEmployee'],
        );

        $positions = Position::limit(4)->get();
        $comfortCategories = ComfortCategory::all();
        foreach ($positions as $position) {
            $assignedCategories = $comfortCategories->random(rand(1, 3));
            foreach ($assignedCategories as $category) {
                DB::table('position_comfort_category')->insert([
                    'position_id' => $position->id,
                    'comfort_category_id' => $category->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
