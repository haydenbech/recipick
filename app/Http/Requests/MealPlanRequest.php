<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealPlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'          => ['required', 'max:255'],
            'start_date'    => ['required', 'date', 'after_or_equal:today'],
        ];
    }
}
