<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PodeVerAlunoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Verifica se o aluno pertence a academia e se tem permissão parace acessar
        $academiaLogada = auth()->user()->academia_id;       
        $permissao = auth()->user()->getPermissionNames()->first();
        $idAcademiaAlunoLogado = $request->route()->parameters['aluno']->academia_id;
        if( $academiaLogada != $idAcademiaAlunoLogado || $permissao == 'aluno'){
            return redirect()->route('home')->with('msg_erro', 'Você não tem permissões para editar esse aluno');           
       }
       return $next($request);   
    }
}
