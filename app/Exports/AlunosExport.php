<?php

namespace App\Exports;

use App\Models\Aluno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlunosExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //Busca todos os alunos da academia que esta "logada"
        $academiaId = auth()->user()->academia_id;
        return Aluno::where('academia_id', $academiaId)->get();
        
    }
    public function headings(): array{
        //Nome de cada coluna da planilha do Excel - "Cabeçalho"
        return['ID', 'Nome', 'E-mail', 'Celular', 'CPF', 'Sexo', 'Data de Nascimento'];
    }

    public function map($linha) : array{
        //Os valores que irá retornar por linha, a linha é o contém o return da função collec 
        return[
            $linha->id,
            $linha->user->name,   
            $linha->user->email,     
            $linha->user->celular, 
            $linha->cpf,     
            ($linha->sexo == 'm' ? 'Masculino' : 'Feminino'),
            date('d/m/Y', strtotime($linha->data_nascimento))
        ];
    }
}
