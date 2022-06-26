@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="mb-2 text-end">
                    <div>
                        <a href="{{ route('academia.create') }}" class="btn btn-dark">
                            Cadastrar academia <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                </div>

                <div class="card bg-dark text-white" style="opacity: .98">
                    <div class="card-body">
                        <h4 class="card-title">Lista de academias</h4>
                        <div class="table-responsive mt-3">

                            <table class="table table-dark table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th><i class="fas fa-sort text-muted"></i> Nome</th>
                                        <th><i class="fas fa-sort text-muted"></i> Email</th>
                                        <th><i class="fas fa-sort text-muted"></i> Enderço</th>
                                        <th><i class="fas fa-sort text-muted"></i> Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($academias->count() == 0)
                                        <tr>
                                            <td colspan="5">Nenhuma Academia cadastrada, clique no link para adicionar
                                                uma
                                                nova
                                                academia. <a href="{{ route('academia.create') }}" class="btn btn-link">
                                                    Cadastrar academia <i class="fas fa-plus-circle"></i>
                                                </a></td>
                                        </tr>
                                    @else
                                        @foreach ($academias as $academia)
                                            <tr>
                                                <td>{{ $academia->id }}</td>
                                                <td>{{ $academia->user->name }}</td>
                                                <td>{{ $academia->user->email }}</td>
                                                <td> {{ $academia->endereco }} </td>
                                                <td class="text-truncate">
                                                    <a href="{{ route('academia.show', $academia->id) }}"
                                                        class="btn btn-secondary" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('academia.edit', $academia->id) }}"
                                                        class="btn btn-secondary" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-secondary" title="Excluir"
                                                        data-bs-toggle="modal" data-bs-target="#modelId"
                                                        onclick="document.getElementById('form-delete').action='{{ route('academia.destroy', $academia->id) }}'">
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
                                        href="{{ $academias->previousPageUrl() }}">Voltar</a></li>
                                @for ($i = 1; $i <= $academias->lastPage(); $i++)
                                    <li class="page-item {{ $academias->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $academias->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item"><a class="page-link"
                                        href="{{ $academias->nextPageUrl() }}">Avançar</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

        </div>

    </div>
    @include('layouts.modal_excluir_registros')


@endsection
