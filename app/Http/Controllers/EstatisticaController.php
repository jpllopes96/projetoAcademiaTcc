<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Professor;
use Illuminate\Http\Request;

class EstatisticaController extends Controller
{
    protected $professoresAll;
    protected $alunosAll;
    protected $id;

    public function __construct(Professor $professores, Aluno $alunos, Request $request)
    {       
         $this->id = $request->route()->parameters['academia'];  
         $this->alunosAll = $alunos->where('academia_id', $this->id)->get(); 
         $this->professoresAll = $professores->where('academia_id', $this->id)->get();     
    }

    //
    public function index($academiaId){
        if(auth()->user()->academia_id == $academiaId){
        $data = [
            'professores' => [
                'total' => Professor::where('academia_id', $academiaId)->count(),
                'data_meses' => $this->estatisticaProfessores(),
            ],
            'alunos' => [
                'total' => Aluno::where('academia_id',  $academiaId)->count(),
                'data_meses' => $this->estatisticaAlunos(),
            ],
            'homens_e_mulheres' => [
                'total' => Aluno::where('academia_id',  $academiaId)->count(),
                'data_chart' => $this->estatisticaHomensMulheres(),
            ],
            'faixa_etaria' => $this->faixaEtaria(),
            
        ];

        return view('estatistica.index', compact('data'));
        }
        return redirect()->route('home')->with('msg_erro', 'Você não pode ver as estatísticas dessa academia'); 
    }


    public function estatisticaProfessores(): array
    {
        $professor = $this->professoresAll->sortBy('created_at')->groupBy('mes');
        $estatisticaProfessores = [
            'meses' => [],
            'dados' => []
        ];
        foreach ($professor as $key => $mes) {
            $estatisticaProfessores['meses'][] = $key;
            $estatisticaProfessores['dados'][] = $mes->count();
        }
        return $estatisticaProfessores;
    }

    public function estatisticaAlunos(): array
    {
        $alunos = $this->alunosAll->sortBy('created_at')->groupBy('mes');
        $estatisticaAlunos = [
            'meses' => [],
            'dados' => []
        ];
        foreach ($alunos as $key => $mes) {
            $estatisticaAlunos['meses'][] = $key;
            $estatisticaAlunos['dados'][] = $mes->count();
        }
        return $estatisticaAlunos;
    }

    public function estatisticaHomensMulheres(): array
    {
        $homensMulheres = [
            'labels' => ['Homens', 'Mulheres'],
            'data' => [
                $this->alunosAll->where('sexo', 'm')->count(),
                $this->alunosAll->where('sexo', 'f')->count(),
            ]
        ];

        return $homensMulheres;
    }

    public function faixaEtaria(): array
    {
        $faixaEtaria = [
            '13 a 20' => $this->alunosAll->whereBetween('idade', [13, 20])->count(),
            '21 a 30' => $this->alunosAll->whereBetween('idade', [21, 30])->count(),
            '31 a 40' => $this->alunosAll->whereBetween('idade', [31, 40])->count(),
            '41 a 50' => $this->alunosAll->whereBetween('idade', [41, 50])->count(),
            '51 a 60+' => $this->alunosAll->whereBetween('idade', [51, 200])->count(),
        ];
        return  [
            'labels' => array_keys($faixaEtaria),
            'data' => array_values($faixaEtaria)
        ];
    }
}
