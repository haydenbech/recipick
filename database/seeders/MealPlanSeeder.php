<?php

namespace Database\Seeders;

use App\Models\MealPlan;
use Illuminate\Database\Seeder;

class MealPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MealPlan::factory()
            ->count(100)
            ->create();
    }
}
