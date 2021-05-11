<?php

namespace App\Http\Controllers;

use App\Http\Requests\MealPlanRequest;
use App\Models\MealPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MealPlanController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('MealPlans/Index', [
            'mealPlans'   => MealPlan::query()
                ->orderByDesc('start_date')
                ->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('MealPlans/Create');
    }

    public function store(MealPlanRequest $request): RedirectResponse
    {
        $mealPlan = MealPlan::create($request->validated());

        $this->banner('Meal plan created.');

        return Redirect::route('mealPlans.show', [$mealPlan]);
    }

    public function show(MealPlan $mealPlan): Response
    {
        return Inertia::render('MealPlans/Show', [
            'mealPlan'   => $mealPlan,
        ]);
    }

    public function edit(MealPlan $mealPlan): Response
    {
        return Inertia::render('MealPlans/Edit', [
            'mealPlan'   => $mealPlan,
        ]);
    }

    public function update(MealPlanRequest $request, MealPlan $mealPlan): RedirectResponse
    {
        $mealPlan->update($request->validated());

        $this->banner('Meal plan saved.');

        return Redirect::route('mealPlans.show', [$mealPlan]);
    }

    public function destroy(MealPlan $mealPlan): RedirectResponse
    {
        $mealPlan->delete();

        $this->banner('Meal plan deleted.');

        return Redirect::route('mealPlans.index');
    }
}
