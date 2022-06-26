<?php

namespace App\Http\Requests\Professor;

use App\Models\Professor;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreProfessorUpdade extends FormRequest
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
        $registroAtual = $this->route('professor')->user_id;
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'celular' => ['required', 'celular_com_ddd', 'unique:users,celular,'.$registroAtual],
        ];
        
    }
}
