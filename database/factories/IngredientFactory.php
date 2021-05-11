<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ingredient;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name'  => $this->faker->sentence(3),
            'slug'  => $this->faker->slug(3),
        ];
    }
}
