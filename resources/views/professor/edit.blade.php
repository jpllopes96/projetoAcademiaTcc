@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-header">Editar Professor</div>
                    <div class="card-body">

                        <form action="{{ route('professor.update', $professor->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row row-cols-2 g-3">

                                <div>
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text"
                                        class="form-control form-control-dark @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name', $professor->user->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text"
                                        class="form-control form-control-dark  @error('celular') is-invalid @enderror"
                                        name="celular" id="celular"
                                        value="{{ old('celular', $professor->user->celular) }}"
                                        placeholder="(99) 98888-8888">
                                    @error('celular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning mt-4"><i class="fas fa-save"></i> Salvar
                                Alterações</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/config-inputs-smask.js') }}"></script>
@endsection
