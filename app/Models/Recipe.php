<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return (new Carbon($date))->diffForHumans();
    }

    /**
     * This can not be a regular Many-To-Many relationship with Ingredients,
     * because a recipe could have the same ingredient more than once,
     * especially if the ingredient needs to be prepared differently.
     */
    public function items(): HasMany
    {
        return $this->hasMany(RecipeItem::class);
    }
}
