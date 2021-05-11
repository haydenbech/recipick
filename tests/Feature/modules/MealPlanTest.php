<?php

namespace Tests\Feature\modules;

use App\Models\MealPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class MealPlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_their_meal_plans(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());
        MealPlan::factory()->count(10)->create();

        // Act
        $response = $this->get(route('mealPlans.index'));

        // Assert
        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page->component('MealPlans/Index')
            ->has('mealPlans', 10, fn(Assert $page) => $page
                ->has('name')
                ->has('start_date')
                ->etc()
            )
        );
    }

    public function test_user_can_view_create_meal_plan_form(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());

        // Act
        $response = $this->get(route('mealPlans.create'));

        // Assert
        $response->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('MealPlans/Create'));
    }

    public function test_user_can_store_a_meal_plan(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());

        // Act
        $response = $this->post(route('mealPlans.store'), [
            'name'          => 'This Week',
            'start_date'    => '2021-05-11',
        ]);

        // Assert
        $this->assertDatabaseHas('meal_plans', [
            'name'          => 'This Week',
            'start_date'    => '2021-05-11',
        ]);
        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('mealPlans.show', ['mealPlan' => MealPlan::value('id')]));
    }

    public function test_user_can_view_a_meal_plan(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());
        $mealPlan = MealPlan::factory()->create();

        // Act
        $response = $this->get(route('mealPlans.show', $mealPlan));

        // Assert
        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page->component('MealPlans/Show'));
        $response->assertInertia(fn (Assert $page) => $page->component('MealPlans/Show')
            ->has('mealPlan', fn(Assert $page) => $page
                ->where('name', $mealPlan->name)
                ->etc()
            )
        );
    }

    public function test_user_can_view_edit_meal_plan_form(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());
        $mealPlan = MealPlan::factory()->create();

        // Act
        $response = $this->get(route('mealPlans.edit', $mealPlan));

        // Assert
        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page->component('MealPlans/Edit')
            ->has('mealPlan', fn(Assert $page) => $page
                ->where('name', $mealPlan->name)
                ->etc()
            )
        );
    }

    public function test_user_can_update_a_meal_plan(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());
        $mealPlan = MealPlan::factory()->create();

        // Act
        $response = $this->put(route('mealPlans.update', $mealPlan), [
            'name'          => 'This Week',
            'start_date'    => '2021-05-11',
        ]);

        // Assert
        $this->assertDatabaseHas('meal_plans', [
            'name'          => 'This Week',
            'start_date'    => '2021-05-11',
        ]);
        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('mealPlans.show', ['mealPlan' => $mealPlan->id]));
    }

    public function test_user_can_delete_a_meal_plan(): void
    {
        // Arrange
        $this->actingAs($user = User::factory()->create());
        $mealPlan = MealPlan::factory()->create();

        // Act
        $response = $this->delete(route('mealPlans.destroy', $mealPlan));

        // Assert
        $this->assertDeleted($mealPlan);
        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('mealPlans.index'));
    }
}
