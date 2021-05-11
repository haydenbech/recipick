<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RecipeItem;

class RecipeItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecipeItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ingredient_id' => Ingredient::factory(),
            'preparation'   => $this->faker->sentence(),
            'quantity'      => $this->faker->numberBetween(1, 5000),
            'unit'          => $this->faker->randomLetter(),
            'order'         => $this->faker->numberBetween(1, 50),
        ];
    }
}
