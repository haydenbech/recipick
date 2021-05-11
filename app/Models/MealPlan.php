<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class MealPlan extends Model
{
    use HasFactory;

    protected $dates = [
        'start_date',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return (new Carbon($date))->format('jS M, Y');
    }
}
