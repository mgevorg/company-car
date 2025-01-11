<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComfortCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comfort_categories')->insert([
            ['name' => 'First'],
            ['name' => 'Second'],
            ['name' => 'Third'],
        ]);
        // Alternatively:
        // Employee::factory()->count(5)->create();
    }
}
