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
            "nome" => 'sometimes|string|min:3|max:50',
            "autor" => 'sometimes|string|min:3|max:50',
            "data_de_lancamento" => 'sometimes|date|date_format:Y-m-d',
            "imagem" => 'sometimes|file|mimes:jpg,png,jpeg',
            "categoria_id" => 'sometimes|uuid|exists:categories,id',
            "quantidade" => 'sometimes|integer|min:0'
        ];

    }
}
