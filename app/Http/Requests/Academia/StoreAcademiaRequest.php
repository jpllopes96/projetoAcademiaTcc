<?php

namespace App\Http\Requests\Academia;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademiaRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
