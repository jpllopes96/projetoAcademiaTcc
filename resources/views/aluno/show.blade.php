@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h4 class="card-title m-0 p-0  h3">{{ $aluno->user->name }}</h4>
                        <span class="text-muted">Aluno(a)</span>

                        <div class="mt-3 fs-5">
                            <div>
                                <span class="text-info"> <i class="fas fa-envelope"></i> E-mail: </span>
                                {{ $aluno->user->email }}
                            </div>
                            <div>
                                <span class="text-info"> <i class="fas fa-phone-square-alt"></i> Celular: </span>
                                {{ $aluno->user->celular }}
                            </div>
                            <div>
                                <span class="text-info"> <i class="far fa-id-card"></i> CPF: </span>
                                {{ $aluno->cpf }}
                            </div>
                            <div>
                                <span class="text-info"> <i class="fas fa-calendar-alt"></i> Data de nascimento:
                                </span>
                                {{ date('d/m/Y', strtotime($aluno->data_nascimento)) }}
                            </div>

                            <div class="mb-4">
                                <span class="text-info"> <i class="fas fa-venus-mars"></i> Sexo: </span>
                                @if ($aluno->sexo == 'm')
                                    Masculino
                                @else
                                    Feminino
                                @endif
                            </div>
                            <a href="{{ route('aluno.edit', $aluno->id) }}"
                                class="btn btn-warning px-3 rounded-pill btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>

                            <a href="{{ route('treino.create', $aluno->id) }}"
                                class="btn btn-primary px-3 rounded-pill btn-sm">
                                <i class="fas fa-dumbbell"></i> Treinos
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
