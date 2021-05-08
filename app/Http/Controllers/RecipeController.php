<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Recipes/Index', [
            'recipes'   => Recipe::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Recipes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeRequest $request): RedirectResponse
    {
        $recipe = Recipe::create($request->validated());

        $this->banner('Recipe created.');

        return Redirect::route('recipes.show', [$recipe]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe): Response
    {
        return Inertia::render('Recipes/Show', [
            'recipe'   => $recipe,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe): Response
    {
        return Inertia::render('Recipes/Edit', [
            'recipe'   => $recipe,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipeRequest $request, Recipe $recipe): RedirectResponse
    {
        $recipe->update($request->validated());

        $this->banner('Recipe saved.');

        return Redirect::route('recipes.show', [$recipe]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe): RedirectResponse
    {
        $recipe->delete();

        $this->banner('Recipe deleted.');

        return Redirect::route('recipes.index');
    }
}
