<?php

namespace App\Http\Requests\Treino;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreinoRequest extends FormRequest
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
            'edit_nome' => ['required', 'min:3'],
            'edit_series' => ['required', 'min:1'],
            'edit_repeticoes' => ['required', 'min:1'],
        ];
    }

    public function attributes()
    {
        return [
            'edit_nome' => 'nome do treino',
            'edit_series' => 'séries',
            'edit_repeticoes' => 'repetições'
        ];
    }

}
