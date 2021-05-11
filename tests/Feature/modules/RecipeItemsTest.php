<?php

namespace Tests\Feature\modules;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeItemsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_new_ingredients(): void
    {
        // Arrange
        $this->actingAs(User::factory()->create());
        $recipe = Recipe::factory()->create();

        // Act
        $response = $this->post(route('recipes.items.store', $recipe), [
            'ingredient_name'   => 'Rump Steak',
            'preparation'       => 'Diced',
            'quantity'          => '500',
            'unit'              => 'g',
            'order'             => '1',
        ]);

        // Assert
        $this->assertDatabaseHas('ingredients', [
            'name'          => 'Rump Steak',
            'slug'          => 'rump-steak',
        ]);
        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('recipes.edit', ['recipe' => $recipe->id]));
    }

    public function test_user_can_add_ingredients_to_a_recipe(): void
    {
        // Arrange
        $this->actingAs(User::factory()->create());
        $recipe = Recipe::factory()->create();

        // Act
        $response = $this->post(route('recipes.items.store', $recipe), [
            'ingredient_name'   => 'Rump Steak',
            'preparation'       => 'Diced',
            'quantity'          => 500,
            'unit'              => 'g',
            'order'             => 1,
        ]);

        // Assert
        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('recipes.edit', ['recipe' => $recipe->id]));

        $ingredient_id = Ingredient::where('name', 'Rump Steak')->value('id');
        $this->assertDatabaseHas('recipe_items', [
            'recipe_id'     => $recipe->id,
            'ingredient_id' => $ingredient_id,
            'preparation'   => 'Diced',
            'quantity'      => 500,
            'unit'          => 'g',
            'order'         => 1,
        ]);
    }

    public function test_user_can_update_recipe_items(): void
    {
        // Arrange
        $this->actingAs(User::factory()->create());
        $recipe = Recipe::factory()
            ->has(RecipeItem::factory(), 'items')
            ->create();
        $item = $recipe->items()->first();

        // Act
        $response = $this->put(route('recipes.items.update', [$recipe, $item]), [
            'ingredient_name'   => 'Rump Steak',
            'preparation'       => 'Diced',
            'quantity'          => 500,
            'unit'              => 'g',
            'order'             => 1,
        ]);

        // Assert
        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('recipes.edit', ['recipe' => $recipe->id]));

        $ingredient_id = Ingredient::where('name', 'Rump Steak')->value('id');
        $this->assertDatabaseHas('recipe_items', [
            'recipe_id'     => $recipe->id,
            'ingredient_id' => $ingredient_id,
            'preparation'   => 'Diced',
            'quantity'      => 500,
            'unit'          => 'g',
            'order'         => 1,
        ]);
    }

    public function test_user_can_delete_recipe_items(): void
    {
        // Arrange
        $this->actingAs(User::factory()->create());
        $recipe = Recipe::factory()
            ->has(RecipeItem::factory(), 'items')
            ->create();
        $item = $recipe->items()->first();

        // Act
        $response = $this->delete(route('recipes.items.destroy', [$recipe, $item]));

        // Assert
        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('recipes.edit', ['recipe' => $recipe->id]));

        $this->assertDeleted($item);
    }
}
