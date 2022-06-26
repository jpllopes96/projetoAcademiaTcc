<?php

namespace App\Http\Controllers;

use App\Exports\AlunosExport;
use App\Http\Requests\Academia\StoreAcademiaRequest;
use App\Http\Requests\Academia\StoreAcademiaUpdate;
use App\Models\Academia;
use App\Models\Aluno;
use App\Models\Perfis;
use App\Models\Professor;
use App\Models\Treino;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AcademiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $this->authorize('admin');
        return view('academia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcademiaRequest $request)
    {
       
        $this->authorize('admin');
        if ($request->file('img_path')) {
            $path = $request->file('img_path')->store('imagens/academias', 'public');
        } else {
            $path = 'imagens/thumb.png';
        }

        $user = User::create([
            'name' => $request['nome'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ])->givePermissionTo('academia');

        $academia = Academia::create([
            'descricao' => $request->descricao,
            'endereco' => $request->endereco,
            'img_path' => $path,
            'user_id' => $user->id
        ]);

        $user->academia_id = $academia->id;
        $user->save();

        return  redirect()
        ->route('home')->with('msg_sucesso', 'Academia cadastrada com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Academia  $academia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $permissao = auth()->user()->getPermissionNames()->first();      
       if($permissao == 'academia' || $permissao =='admin'){
            if( auth()->user()->academia_id == $id || $permissao =='admin'){
                $academia = Academia::findOrFail($id);
                return view('academia.show', ['academia' => $academia]);
            }
       return redirect()->route('home')->with('msg_erro', 'Você não possui acesso a essa academia');
    }   
    
    return redirect()->route('home')->with('msg_erro', 'Você não possui acesso a essa academia');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Academia  $academia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissao = auth()->user()->getPermissionNames()->first(); 
        if($permissao == 'admin'){
            $academia = Academia::where('id', $id)->first();
            return view('academia.edit', ['academia' => $academia]);
        }        
        return redirect()->route('home')->with('msg_erro', 'Você não possui para editar essa academia');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Academia  $academia
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAcademiaUpdate $request, $id)
    {       
        $academia = Academia::where('id', $id)->first();
        $this->authorize('admin');

        if ($request->file('img_path')) {
            $path = $request->file('img_path')->store('imagens/academias', 'public');
            if ($academia->img_path && $academia->img_path != 'imagens/thumb.png') {
                unlink(public_path($academia->img_path));
            }
        } else {
            $path = $academia->img_path;
        }

        $user = User::find($academia->user_id)->update([
            'name' => $request->nome,            
            
        ]);
       
        $academia->update([
            'descricao' => $request->descricao,
            'endereco' => $request->endereco,
            'img_path' => $path,
        ]);
        
        return  redirect()
            ->route('home')->with('msg_sucesso', 'Academia editada com sucesso!');
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Academia  $academia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $this->authorize('admin');
       //Verifica se tem aluno, treino, e professor associado a academia e faz a remoção em cascata
        if( count(Aluno::all()) > 0){
            $userIdAulo = Aluno::where('academia_id', $id)->first()->user_id;
            if( count(Treino::all()) > 0){
                Treino::where('user_id', $userIdAulo)->delete();
            }
            Aluno::where('academia_id', $id)->delete();
        }
        if(count(Professor::all()) > 0){
            Professor::where('academia_id', $id)->delete();
        }   
                
        Academia::where('id', $id)->delete();
        User::where('academia_id', $id)->delete();
        return  redirect('home')->with('msg_sucesso', 'Academia removida com sucesso!');
    }

    public function exportar(){
        //Export os alunos da academia em excel
        $permissao = auth()->user()->getPermissionNames()->first();
        if($permissao == 'academia'){
            return Excel::download(new AlunosExport, 'Alunos-Academia-'.auth()->user()->name.'.xlsx');
        }
        return  redirect('home')->with('msg_erro', 'Você não pode exportar alunos');
    }
}
