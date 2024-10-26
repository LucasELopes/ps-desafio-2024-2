<?php

namespace App\Http\Requests\BookRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        return [
            "name" => 'sometimes|string|min:3|max:50',
            "author" => 'sometimes|string|min:3|max:50',
            "release_date" => 'sometimes|date|date_format:Y-m-d',
            "image" => 'sometimes|file|mimes:jpg,png,jpeg',
            "category_id" => 'sometimes|array',
            "category_id.*" => 'uuid|exists:categories,id',
            "quantity" => 'sometimes|integer|min:0'
        ];

    }
}
