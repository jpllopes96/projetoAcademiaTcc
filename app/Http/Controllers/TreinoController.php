<?php

namespace App\Http\Controllers;

use App\Http\Requests\Treino\StoreTreinoRequest;
use App\Models\Aluno;
use App\Models\SemanaDias;
use App\Models\Treino;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TreinoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verificaAluno', ['only' =>['show', 'edit', 'delete', 'create']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Aluno $aluno)
    {
        //
        $diasDaSemana = SemanaDias::all();
        $diaSelecionado = $request->dia_da_semana ?? 1;
        //Seleciona todos os treinos do aluno, depois verificar os treinos do dia selecionado para retornar
        $treinosParaDiaSelecionado = Treino::where('user_id', $aluno->user_id)
            ->whereHas('dia', function ($d) use ($diaSelecionado) {
                return $d->where('id', $diaSelecionado);
            })->get();
        return view('treino.create', ['aluno' => $aluno, 'diasDaSemana' => $diasDaSemana, 'treinosParaDiaSelecionado' => $treinosParaDiaSelecionado ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreinoRequest $request, Aluno $aluno)
    {
        if($request->video){
            //Converte o link do youtube para o padão embed
            $url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$2",$request->video);
            $treino = (new Treino)->fill($request->all());
            $treino->video = $url;
        } else{
            $treino = (new Treino)->fill($request->all());
        }         
        $treino->user_id = $aluno->user_id;
        $treino->save();
        return redirect()->back()->with('msg_sucesso', 'Treino adicionado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treino  $treino
     * @return \Illuminate\Http\Response
     */
    public function show(Treino $treino)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treino  $treino
     * @return \Illuminate\Http\Response
     */
    public function edit(Treino $treino)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treino  $treino
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treino $treino)
    {
        $aluno=User::find($request->id_aluno);

        $treino = Treino::find($request->edit_id);
        if($request->edit_video){
             //Converte o link do youtube para o padão embed
            $url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$2",$request->edit_video);
            $treino->video = $url;         
        }else{
            $treino->video = null;
        }
        $treino->treino= $request->edit_nome;
        $treino->series= $request->edit_series;
        $treino->repeticoes= $request->edit_repeticoes;
        $treino->carga= $request->edit_carga;
        $treino->save();

        return redirect()->back()->with('msg_sucesso', 'Treino editado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treino  $treino
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treino $treino)
    {
        $treino->delete();
        return redirect()->back()->with('msg_sucesso', 'Treino excluído!');
    }

    public function exportar(){
        //Exporta todos os treinos em PDF
        $permissao = auth()->user()->getPermissionNames()->first();
        if($permissao == 'aluno'){
            $aluno = Aluno::where('user_id', auth()->user()->id)->first();
            // Array com as ["chaves"] treinos e dias das semanas par assimilar o trieno ao dia da semana
            $treinos = $this->dadosTreinosDoAluno();
            $pdf = PDF::loadView('treino.pdf', ['aluno' => $aluno, 'treinos' => $treinos]);
            return $pdf->download('treino-'.$aluno->user->name.'.pdf');
        }
        return  redirect('home')->with('msg_erro', 'Você não pode exportar treinos');
        
    }
    public function dadosTreinosDoAluno(): array
    {
        $treinosDoAluno = [
            'diasdasemana' => [
                1 => "Segunda-Feira",
                2 => "Terça-Feira",
                3 => "Quarta-Feira",
                4 => "Quinta-Feira",
                5 => "Sexta-Feira",
                6 => "Sábado",
                7 => "Domingo"
            ],
            'treinos' => auth()->user()->treino->groupBy('semana_dia_id', 'asc')
        ];

        return $treinosDoAluno;
    }
}
