@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-dark text-white pb-4 pt-3">
                    <div class="card-body">
                        <h1 class="card-title mb-3 fw-bold">{{ $professor->user->name }}</h1>
                        <div>
                            <div class="fw-bold text-light opacity-75 my-2">
                                <i class="fa-solid fa-dumbbell"></i> {{ $professor->academia->user->name }}<br>
                                <i class="fa-solid fa-mobile-screen-button"></i>
                                {{ $professor->user->celular }}<br>
                                <i class="fas fa-envelope"></i> {{ $professor->user->email }}

                            </div>

                            <div class=" mt-3">
                                <a href="{{ route('professor.edit', $professor->id) }}"
                                    class="btn btn-danger btn-sm rounded-pill px-3">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
