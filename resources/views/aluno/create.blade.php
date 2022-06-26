@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Cadastrar aluno</h4>

                        <form action="{{ route('aluno.store') }}" method="post">
                            @csrf

                            <div class="row row-cols-1 row-cols-lg-3 g-3">

                                <div>
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text"
                                        class="form-control form-control-dark @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" name="name" id="nome">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text"
                                        class="form-control form-control-dark  @error('cpf') is-invalid @enderror"
                                        value="{{ old('cpf') }}" name="cpf" id="cpf">
                                    @error('cpf')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text"
                                        class="form-control form-control-dark @error('celular') is-invalid @enderror"
                                        value="{{ old('celular') }}" name="celular" id="celular"
                                        placeholder="(99) 98888-8888">
                                    @error('celular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="data-nascimento" class="form-label">Data de nascimento</label>
                                    <input type="date"
                                        class="form-control form-control-dark @error('data_nascimento') is-invalid @enderror"
                                        value="{{ old('data_nascimento') }}" name="data_nascimento" id="data-nascimento">
                                    @error('data_nascimento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select class="form-select  text-white form-control-dark bg-dark border-0" name="sexo"
                                        id="sexo">
                                        <option class="text-dark" value="m"
                                            @if (old('sexo') == 'm') selected @endif>Masculino</option>
                                        <option class="text-dark" value="f"
                                            @if (old('sexo') == 'f') selected @endif>Feminino</option>
                                    </select>
                                </div>

                            </div>

                            <h5 class="mt-4">Dados para acesso</h5>
                            <div class="row row-cols-1 row-cols-lg-3 g-3">
                                <div>
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text"
                                        class="form-control form-control-dark @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" name="email" id="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

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
                                <i class="fas fa-save"></i> Cadastrar
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/config-inputs-smask.js') }}"></script>
@endsection
