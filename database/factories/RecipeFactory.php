<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->sentence(),
            'description'       => $this->faker->paragraph(),
            'preparation_time'  => $this->faker->numberBetween(1, 255),
            'cooking_time'      => $this->faker->numberBetween(1, 255),
            'servings'          => $this->faker->numberBetween(1, 8),
            'effort'            => $this->faker->numberBetween(1, 10),
            'rating'            => $this->faker->numberBetween(1, 10),
        ];
    }
}
