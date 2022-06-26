<?php

namespace App\Http\Requests\Aluno;

use App\Models\Aluno;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class UpdateAlunoRequest extends FormRequest
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
        $registroAtual = $this->route('aluno')->user_id;
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'data_nascimento' => ['required', 'date'],
            'sexo' => ['required'],
            'cpf' => ['required', 'formato_cpf', function ($attribute, $value, $fail) {
                $perfis =  Aluno::all(['cpf', 'id'])->filter(function ($perfil) use ($value) {
                    if ($perfil->cpf) 
                        if ($perfil->cpf == $value && $this->aluno->id != $perfil->id) {
                            return $perfil;
                        }
                });

                if (count($perfis) > 0) {
                    return $fail('O ' . $attribute . ' já está sendo utilizado.');
                }
            },],
            'celular' => ['required', 'celular_com_ddd', 'unique:users,celular,'.$registroAtual],
        ];
    }

    public function attributes()
    {
        return [
            'data_nascimento' => 'data de nascimento'
        ];
    }
}
