<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeItemController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(static function(){

    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

    Route::resource('recipes', RecipeController::class);
    Route::resource('recipes.items', RecipeItemController::class)->only(['store', 'update', 'destroy']);
});

