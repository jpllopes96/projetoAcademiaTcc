<?php

namespace App\Http\Controllers;

use App\Models\Academia;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Treino;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $academiaIdLogado = auth()->user()->academia_id;
        $academias = Academia::orderBy('created_at', 'desc')->paginate(10);
        $professores = Professor::where('academia_id', $academiaIdLogado)->orderBy('created_at', 'desc')->paginate(10);
        $alunos = Aluno::where('academia_id', $academiaIdLogado)->orderBy('created_at', 'desc')->paginate(10);
        // Array com as ["chaves"] treinos e dias das semanas par assimilar o trieno ao dia da semana
        $treinos = $this->dadosTreinosDoAluno();      
        return view('home', ['academias' => $academias, 'professores' => $professores, 'alunos' => $alunos, 'treinos' => $treinos]);
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
