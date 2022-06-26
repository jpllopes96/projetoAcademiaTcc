<?php

namespace App\Http\Requests\Aluno;

use App\Models\Aluno;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreAlunoRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'data_nascimento' => ['required', 'date'],
            'sexo' => ['required'],
            'cpf' => ['required', 'formato_cpf', function ($attribute, $value, $fail) {
                $perfis =  Aluno::all(['cpf'])->filter(function ($perfil) use ($value) {
                    if ($perfil->cpf)
                        if ($perfil->cpf == $value) {
                            return $perfil;
                        }
                });

                if (count($perfis) > 0) {
                    return $fail('O ' . $attribute . ' já está sendo utilizado.');
                }
            },],
            'celular' => ['required', 'celular_com_ddd', 'unique:users'],   
        ];
    }

    public function attributes()
    {
        return [
            'data_nascimento' => 'data de nascimento'
        ];
    }
}
