<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoieRequestStore extends FormRequest
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
            "libelle"=>["required","string","min:3","unique:categories"],
            "unite"=>["required","string","min:3","unique:unites,libelle"]
        ];
    }
}
