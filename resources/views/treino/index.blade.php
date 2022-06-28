@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card bg-dark text-white" style="opacity: .98">
            <div class="card-body ">

                <div class="d-flex justify-content-between">
                    <button class="btn btn-danger p-2 py-1" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <i class="fas fa-arrow-circle-left"></i>
                        <span class="visually-hidden">Anterior</span>
                    </button>

                    <button class="btn btn-danger p-2 py-1" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <i class="fas fa-arrow-circle-right"></i>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>

                <div id="carouselExampleCaptions" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($treinos['diasdasemana'] as $key => $dia)
                            <div class="carousel-item @if ($key == date('N')) active @endif">
                                <h4 class="card-title text-center fw-bold">{{ $dia }}</h4>
                                <div class="container pb-3">
                                    <div class="table-responsive">
                                        <table class="table table-dark table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Treino</th>
                                                    <th>
                                                        <i class="fas fa-sort text-muted"></i>
                                                        <span class="d-none d-lg-inline-block"> Séries</span>
                                                        <span class="d-lg-none">S</span>
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-retweet text-muted"></i>
                                                        <span class="d-none d-lg-inline-block"> Repetições</span>
                                                        <span class="d-lg-none">R</span>
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-retweet text-muted"></i>
                                                        <span class="d-none d-lg-inline-block"> Carga</span>
                                                        <span class="d-lg-none">C</span>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($treinos['treinos'][$key]))
                                                    @foreach ($treinos['treinos'][$key] as $treino)
                                                        <tr>
                                                            <td style="min-width: 10ch;">{{ $treino->treino }} </td>
                                                            <td>{{ $treino->series }}</td>
                                                            <td>{{ $treino->repeticoes }}</td>
                                                            <td>{{ $treino->carga }}</td>
                                                            @if ($treino->video)
                                                                <td>

                                                                    <iframe class="embed-responsive-item"
                                                                        src="{{ $treino->video }}"
                                                                        allowfullscreen></iframe>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="p-3 text-center text-muted">
                                                            Não há treinos para este dia.
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
