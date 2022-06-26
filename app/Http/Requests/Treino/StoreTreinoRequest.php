<?php

namespace App\Http\Requests\Treino;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreinoRequest extends FormRequest
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
            'semana_dia_id' => ['required', 'exists:semana_dias,id'],
            'treino' => ['required', 'min:3'],
            'series' => ['required', 'min:1'],
            'repeticoes' => ['required', 'min:1'],
        ];
    }

    public function attributes()
    {
        return [
            'series' => 'séries',
            'repeticoes' => 'repetições',
            'semana_dia_id' => 'dia da semana',
        ];
    }
}
