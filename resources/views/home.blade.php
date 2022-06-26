@extends('layouts.app')

@section('content')
    <div class="container">
        @can('admin')
            @include('academia.index', ['academias' => $academias])
        @endcan
        @can('academia')
            @include('professor.index', ['professores' => $professores, 'alunos' => $alunos])
        @endcan
        @can('professor')
            @include('aluno.index', ['alunos' => $alunos])
        @endcan
        @can('aluno')
            @include('treino.index', ['treinos' => $treinos])
        @endcan
    </div>
@endsection
