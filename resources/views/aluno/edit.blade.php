@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Editar Aluno(a)</h4>

                        <form action="{{ route('aluno.update', $aluno->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row row-cols-1 row-cols-lg-3 g-3">
                                <div>
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text"
                                        class="form-control form-control-dark @error('name') is-invalid @enderror"
                                        value="{{ old('name', $aluno->user->name) }}" name="name" id="nome">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text"
                                        class="form-control form-control-dark  @error('cpf') is-invalid @enderror"
                                        value="{{ old('cpf', $aluno->cpf) }}" name="cpf" id="cpf">
                                    @error('cpf')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text"
                                        class="form-control form-control-dark @error('celular') is-invalid @enderror"
                                        value="{{ old('celular', $aluno->user->celular) }}" name="celular" id="celular"
                                        placeholder="(99) 98888-8888">
                                    @error('celular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="data-nascimento" class="form-label">Data de nascimento</label>
                                    <input type="date" value="{{ old('data_nascimento', $aluno->data_nascimento) }}"
                                        class="form-control form-control-dark @error('data_nascimento') is-invalid @enderror"
                                        name="data_nascimento" id="data-nascimento">
                                    @error('data_nascimento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select class="form-select form-control-dark border-0" name="sexo" id="sexo">
                                        <option class="text-dark" value="m"
                                            @if (old('sexo', $aluno->sexo) == 'm') selected @endif>Masculino</option>
                                        <option class="text-dark" value="f"
                                            @if (old('sexo', $aluno->sexo) == 'f') selected @endif>Feminino</option>
                                    </select>
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
