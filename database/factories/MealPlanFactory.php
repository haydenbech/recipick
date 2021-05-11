<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MealPlan;

class MealPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MealPlan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name'          => $this->faker->sentence,
            'start_date'    =>  $this->faker->dateTimeThisYear(),
        ];
    }
}
