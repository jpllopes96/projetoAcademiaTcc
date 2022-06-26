<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ModificarDadosAcessoController extends Controller
{
    public function index($userId){

        //Encontrar o usuario de acordo com o ID da rota e do user logado
        if(auth()->user()->id == $userId){
            $user = User::find($userId);
            return view('modificarDadosAcesso.index', ['user' => $user]);
        }
        return redirect()->route('home')->with('msg_erro', 'Você não pode alterar dados de outro usuário');
    }

    public function update(Request $request, $userId){
       
        if(auth()->user()->id == $userId){
            //Se o celular já for null pode continuar null(isso é considerado em academias e admin)
            if(auth()->user()->celular != null){
                $request
                ->validate([
                    'celular' => ['required', 'string', 'unique:users,celular,' . auth()->user()->id],             
                ]);
            }
            $request
                ->validate([
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
                    'password' => ['required', 'string', 'min:6', 'confirmed'],                
                ]);
            $user = User::where('id', auth()->user()->id);
            $user->update([
                'email' => $request->email,
                'celular' => $request->celular,
                'password' => bcrypt($request->password),
            ]);

            return  redirect()
            ->route('home')->with('msg_sucesso', 'Dados alterados com sucesso!');
        }
        return  redirect()
        ->route('home')->with('msg_erro', 'Você não pode alterar dados de outro usuário');
    }
}
