@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">


            {{-- Table --}}
            @component('aluno.component.table_listar_alunos', ['alunos' => $alunos])
            @endcomponent

        </div>

    </div>
    @include('layouts.modal_excluir_registros')
@endsection
