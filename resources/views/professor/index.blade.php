@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="mb-2 text-end">
                    <div>
                        <a href="{{ route('professor.create') }}" class="btn btn-dark">
                            Cadastrar Professor <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                </div>
                <div class="card bg-dark text-white" style="opacity: .98">
                    <div class="card-header">Lista de Professores</div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">

                            <table class="table table-dark table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-sort text-muted"></i> Nome</th>
                                        <th><i class="fas fa-sort text-muted"></i> Celular
                                        </th>
                                        <th><i class="fas fa-sort text-muted"></i> Email
                                        </th>
                                        <th><i class="fas fa-sort text-muted"></i> Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($professores->count() == 0)
                                        <tr>
                                            <td colspan="5">Nenhum Professor cadastrado, clique no link para adicionar um
                                                novo
                                                Professor. <a href="{{ route('professor.create') }}" class="btn btn-link">
                                                    Cadastrar Professor
                                                </a></td>
                                        </tr>
                                    @else
                                        @foreach ($professores as $professor)
                                            <tr>
                                                <td style="min-width: 10ch;">{{ $professor->user->name }}</td>
                                                <td style="min-width: 16ch;">{{ $professor->user->celular }}</td>
                                                <td>{{ $professor->user->email }}</td>
                                                <td class="text-truncate">
                                                    <a href="{{ route('professor.show', $professor->id) }}"
                                                        class="btn btn-secondary" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('professor.edit', $professor->id) }}"
                                                        class="btn btn-secondary" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-secondary" title="Excluir"
                                                        data-bs-toggle="modal" data-bs-target="#modelId"
                                                        onclick="document.getElementById('form-delete').action='{{ route('professor.destroy', $professor->id) }}'">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>


                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $professores->previousPageUrl() }}">Voltar</a></li>
                                @for ($i = 1; $i <= $professores->lastPage(); $i++)
                                    <li class="page-item {{ $professores->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $professores->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item"><a class="page-link"
                                        href="{{ $professores->nextPageUrl() }}">Avançar</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                @component('aluno.component.table_listar_alunos', ['alunos' => $alunos])
                @endcomponent
            </div>
        </div>
    </div>
    @include('layouts.modal_excluir_registros')
@endsection
