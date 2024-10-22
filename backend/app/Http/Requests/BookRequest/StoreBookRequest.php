<?php

namespace App\Http\Requests\BookRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            "nome" => 'required|string|min:3|max:50',
            "autor" => 'required|string|min:3|max:50',
            "data_de_lancamento" => 'required|date|date_format:Y-m-d',
            "imagem" => 'required|file|mimes:jpg,png,jpeg',
            "category_id" => 'required|array',
            "category_id.*" => 'uuid|exists:categories,id',
            "quantidade" => 'required|integer|min:0'
        ];
        
    }

}
