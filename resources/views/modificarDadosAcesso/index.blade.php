@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Editar Dados de Acesso</h4>

                        <form action="{{ route('modificar-dados', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row row-cols-1 row-cols-lg-3 g-3">
                                <div>
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email"
                                        class="form-control form-control-dark @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" name="email" id="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                @canany(['professor', 'aluno'])
                                    <div>

                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text"
                                            class="form-control form-control-dark @error('celular') is-invalid @enderror"
                                            value="{{ old('celular', $user->celular) }}" name="celular" id="celular"
                                            placeholder="(99) 98888-8888">
                                        @error('celular')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endcanany
                                <div>
                                    <label for="password" class="form-label">Senha</label>
                                    <input type="password"
                                        class="form-control form-control-dark @error('password') is-invalid @enderror"
                                        name="password" id="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="r_password" class="form-label">Repetir Senha</label>
                                    <input type="password" class="form-control form-control-dark"
                                        name="password_confirmation" id="r_password">
                                </div>

                            </div>

                            <button type="submit" class="btn btn-warning mt-3">
                                <i class="fas fa-save"></i> Salvar alterações
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/config-inputs-smask.js') }}"></script>
@endsection
