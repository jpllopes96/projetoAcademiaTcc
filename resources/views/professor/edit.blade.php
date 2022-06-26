@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Editar Professor</h4>

                        <form action="{{ route('professor.update', $professor->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row row-cols-3 g-3">

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

                            <h5 class="mt-4">Dados para login</h5>
                            <div class="row row-cols-3 g-3">
                                <div>
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text"
                                        class="form-control form-control-dark bg-dark text-muted @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email', $professor->user->email) }}"
                                        readonly>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="form-label">Senha</label>
                                    <input type="password"
                                        class="form-control form-control-dark bg-dark text-muted @error('password') is-invalid @enderror"
                                        name="password" id="password" value="********" readonly>
                                    @error('password')
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
