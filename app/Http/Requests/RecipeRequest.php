<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'name'              => ['required', 'max:255'], // 255 chars in a varchar
            'description'       => ['max:65535'], // 65535 chars in a text
            'preparation_time'  => ['nullable', 'numeric', 'min:1', 'max:1440'], // 1440 sec in a day
            'cooking_time'      => ['nullable', 'numeric', 'min:1', 'max:1440'], // 1440 sec in a day
            'servings'          => ['nullable', 'numeric', 'min:1', 'max:8'], // Totally arbitrary, but 10 sounded like a lot
            'effort'            => ['nullable', 'numeric', 'min:1', 'max:10'],
            'rating'            => ['nullable', 'numeric', 'min:1', 'max:10'], // 5 stars with halves
        ];
    }
}
