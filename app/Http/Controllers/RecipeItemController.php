<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeItemRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class RecipeItemController extends Controller
{
    public function store(Recipe $recipe, RecipeItemRequest $request): RedirectResponse
    {
        $ingredient = Ingredient::firstOrCreate(
            ['slug' => Str::slug($request->input('ingredient_name'))],
            ['name' => $request->input('ingredient_name')]
        );
        $item = $recipe->items()->create(array_merge(
            $request->only(['preparation', 'quantity', 'unit', 'order']),
            ['ingredient_id' => $ingredient->id],
        ));

        $this->banner('Item added.');

        return Redirect::route('recipes.edit', [$recipe]);
    }

    public function update(Recipe $recipe, RecipeItem $item, RecipeItemRequest $request): RedirectResponse
    {
        $ingredient = Ingredient::firstOrCreate(
            ['slug' => Str::slug($request->input('ingredient_name'))],
            ['name' => $request->input('ingredient_name')]
        );
        $item->update(array_merge(
            $request->only(['preparation', 'quantity', 'unit', 'order']),
            ['ingredient_id' => $ingredient->id],
        ));

        $this->banner('Item updated.');

        return Redirect::route('recipes.edit', [$recipe]);
    }

    public function destroy(Recipe $recipe, RecipeItem $item): RedirectResponse
    {
        $item->delete();

        $this->banner('Item deleted.');

        return Redirect::route('recipes.edit', [$recipe]);
    }
}
