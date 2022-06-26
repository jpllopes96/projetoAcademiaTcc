<?php

namespace App\Http\Controllers;

use App\Http\Requests\Professor\StoreProfessorRequest;
use App\Http\Requests\Professor\StoreProfessorUpdade;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProfessorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verificaAcademia', ['only' =>['show', 'edit', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissao = auth()->user()->getPermissionNames()->first(); 
        if($permissao == 'academia'){ 
            return view('professor.create');
        }
        return redirect()->route('home')->with('msg_erro', 'Você não possui permissões para criar professores');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfessorRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'celular' => $request['celular'],
            'password' => bcrypt($request['password']),
        ])->givePermissionTo('professor');

        $professor = Professor::create([           
            'academia_id' => auth()->user()->academia_id,
            'user_id' => $user->id,
        ]);

        $user->academia_id = auth()->user()->academia_id;
       
        $user->save();

        return redirect()->route('home')->with('msg_sucesso', 'Professor(a) cadastrado(a) com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor, Request $request)
    {
        //middleware verifica se o professor é da academia e as permissões
        return view('professor.show', ['professor' => $professor]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
         //middleware verifica se o professor é da academia     
        return view('professor.edit', ['professor' => $professor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProfessorUpdade $request, Professor $professor)
    {
        $user = User::find($professor->user_id)->update([
            'name' => $request->name,    
            'celular' =>$request->celular,        
        ]);
        return  redirect()->route('home')->with('msg_sucesso', 'Professor(a) editado(a) com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        //middleware verifica se o professor é da academia 
        $professor->delete();
        User::where('id', $professor->user_id)->delete();
        return redirect('home')->with('msg_sucesso', 'Professor(a) removido(a) com sucesso!');   
    }
}
