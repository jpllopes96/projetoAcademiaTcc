<?php

namespace App\Http\Middleware;

use App\Models\Professor;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;


class AcademiaLogadaMiddleware 
{
    use HasRoles;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        //Verifica a academia logada para ver se o professor pertense a academia e verifica a pemrissão de Academia
        $academiaLogada = auth()->user()->academia_id;       
        $idProfessorLogado = $request->route()->parameters['professor']->academia_id; 
        $permissao = auth()->user()->getPermissionNames()->first(); 
        if($permissao == 'academia'){      
            if( $academiaLogada != $idProfessorLogado){
                return redirect()->route('home')->with('msg_erro', 'Esse(a) Professor(a) não pertence a essa academia');         
            }
        
       return $next($request);  
        }
        return redirect()->route('home')->with('msg_erro', 'Você não possui permissões para acessar essa rota');     
    }
}
