<?php

namespace Tests\Feature\modules;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_their_recipes(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());
        Recipe::factory()->count(10)->create();

        // Act
        $response = $this->get(route('recipes.index'));

        // Assert
        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page->component('Recipes/Index')
            ->has('recipes', 10, fn(Assert $page) => $page
                ->has('name')
                ->etc()
            )
        );
    }

    public function test_user_can_view_a_recipe(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());
        $recipe = Recipe::factory()->create();

        // Act
        $response = $this->get(route('recipes.show', $recipe));

        // Assert
        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page->component('Recipes/Show')
            ->has('recipe', fn(Assert $page) => $page
                ->where('name', $recipe->name)
                ->etc()
            )
        );
    }
}
