@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-dark text-white pb-4 pt-3">
                    <div class="card-body">
                        <h1 class="card-title mb-3 fw-bold">{{ $academia->user->name }}</h1>

                        <div>
                            <img src="{{ asset($academia->img_path) }}" style="max-width: 150px;"
                                alt="{{ $academia->nome }}" class="float-lg-start me-3 mb-3 rounded ">
                            <p class="fs-5">
                                {{ $academia->descricao }}
                            </p>

                            <div class="fw-bold text-light opacity-75 my-2">
                                <i class="fas fa-map-marker-alt"></i> {{ $academia->endereco }}<br>
                                <i class="fas fa-envelope"></i> {{ $academia->user->email }}

                            </div>

                            @can('admin')
                                <div class=" mt-3">
                                    <a href="{{ route('academia.edit', $academia->id) }}"
                                        class="btn btn-danger btn-sm rounded-pill px-3">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </div>
                            @endcan

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
