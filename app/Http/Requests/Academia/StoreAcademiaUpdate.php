<?php

namespace App\Http\Requests\Academia;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademiaUpdate extends FormRequest
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
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'min:3', 'string', 'max:255'],
            'endereco' => ['required', 'min:3', 'max:255'],
            'descricao' => ['required', 'min:3'],
        ];
    }
    public function attributes()
    {
        return [
            'endereco' => 'endereço',
            'descricao' => 'descrição'
        ];
    }
}
