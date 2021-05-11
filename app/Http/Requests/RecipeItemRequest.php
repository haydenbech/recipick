<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'ingredient_name' => ['required', 'max:255'],
            'preparation'     => ['max:255'],
            'quantity'        => ['required', 'numeric'],
            'unit'            => ['required', 'max:3'],
            'order'           => ['nullable', 'numeric', 'max:255'],
        ];
    }
}
