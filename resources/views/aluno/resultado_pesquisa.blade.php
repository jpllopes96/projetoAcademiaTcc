@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">


            {{-- Table --}}
            <div class="mb-2 text-end mt-5">
                <div>
                    <a href="{{ route('aluno.create') }}" class="btn btn-warning">
                        Cadastrar Aluno <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>


            <div class="card bg-dark text-white" style="opacity: .98">
                <div class="card-body">
                    <h4 class="card-title">Lista Alunos</h4>
                    <div class="table-responsive mt-3">

                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-sort text-muted"></i> Nome</th>
                                    <th><i class="fas fa-sort text-muted"></i> Celular</th>
                                    <th><i class="fas fa-sort text-muted"></i> E-mail</th>
                                    <th><i class="fas fa-sort text-muted"></i> Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($alunos) == 0)
                                    <tr>
                                        <td colspan="5">Nenhum Aluno cadastrado, clique no link para adicionar um
                                            novo
                                            Aluno. <a href="{{ route('aluno.create') }}" class="btn btn-link">
                                                Cadastrar Aluno
                                            </a></td>
                                    </tr>
                                @else
                                    @foreach ($alunos as $aluno)
                                        <tr>
                                            <td>{{ $aluno->user->name }}</td>
                                            <td>{{ $aluno->user->celular }}</td>
                                            <td>{{ $aluno->user->email }}</td>
                                            <td class="text-truncate">
                                                <a href="{{ route('treino.create', $aluno->id) }}"
                                                    class="btn btn-secondary" title="Treinos">
                                                    <i class="fas fa-dumbbell"></i>
                                                </a>
                                                <a href="{{ route('aluno.show', $aluno->id) }}" class="btn btn-secondary"
                                                    title="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('aluno.edit', $aluno->id) }}" class="btn btn-secondary"
                                                    title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-secondary" title="Excluir"
                                                    data-bs-toggle="modal" data-bs-target="#modelId"
                                                    onclick="document.getElementById('form-delete').action='{{ route('aluno.destroy', $aluno->id) }}'">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.modal_excluir_registros')
@endsection
