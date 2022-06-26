<?php

namespace App\Http\Controllers;

use App\Http\Requests\Aluno\StoreAlunoRequest;
use App\Http\Requests\Aluno\UpdateAlunoRequest;
use App\Models\Aluno;
use App\Models\Treino;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AlunoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
        $this->middleware('verificaAluno', ['only' =>['show', 'edit', 'delete']]);
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
        return view('aluno.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlunoRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'celular' =>$request->celular,
        ])->givePermissionTo('aluno');

        $aluno = Aluno::create([
            'cpf' =>$request->cpf,
            'academia_id' => auth()->user()->academia_id,
            'sexo' => $request->sexo,
            'data_nascimento' => $request->data_nascimento,
            'user_id' => $user->id,
        ]);

        $user->academia_id = auth()->user()->academia_id;
        $user->save();

        return redirect()->route('home')->with('msg_sucesso', 'Aluno(a) cadastrado(a) com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        return view('aluno.show', ['aluno' =>$aluno]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        $this->middleware('verificaAluno');
        return view('aluno.edit', ['aluno'=> $aluno]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlunoRequest $request, Aluno $aluno)
    {
        $user = User::find($aluno->user_id)->update([
            'name' => $request->name,       
            'celular' => $request->celular,     
            
        ]);
       
        $aluno->update([
            'cpf' =>$request->cpf,            
            'academia_id' => auth()->user()->academia_id,
            'sexo' => $request->sexo,
            'data_nascimento' => $request->data_nascimento,           
        ]);
        
        return  redirect()->route('home')->with('msg_sucesso', 'Aluno(a) editado(a) com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        if( count(Treino::all()) > 0){
            Treino::where('user_id', $aluno->user_id)->delete();
        }
        $aluno->delete();
        User::where('id', $aluno->user_id)->delete();
        return redirect()->route('home')->with('msg_sucesso', 'Aluno(a) removido(a) com sucesso!');
        
    }
    public function pesquisar(Request $request)
    {
        $permissao = auth()->user()->getPermissionNames()->first();
        if($permissao == 'academia' || $permissao == 'professor'){
            $usersId = User::permission('aluno')->where('name', 'like', '%' . $request->p . '%')->where('academia_id',auth()->user()->academia_id)->orderBy('created_at', 'desc')->get();  
            $alunos=[];
            foreach ($usersId as $ids){
                $aluno = Aluno::where('user_id', $ids->id)->first();      
                $alunos[]= $aluno;
            }
            
            return view('aluno.resultado_pesquisa', ['alunos' => $alunos]);
        }
        return  redirect()->route('home')->with('msg_erro', 'Você não tem permissão para pesquisar aluno');
    }
}
