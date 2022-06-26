@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-header">Cadastrar Nova Academia</div>

                    <div class="card-body">
                        <form action="{{ route('academia.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-cols-3 g-3">

                                <div>
                                    <div class="mb-2">Foto da academia</div>
                                    <div class="d-flex">
                                        <img src="{{ asset('imagens/thumb.png') }}" id="img-selecionada" width="130"
                                            alt="Foto da academia">

                                        <div class="ms-2">
                                            <button type="button" class="btn btn-danger"
                                                onclick="document.getElementById('img-path').click()">
                                                <i class="fas fa-image"></i> Selecionar foto
                                            </button>
                                        </div>

                                        <input type="file" name="img_path" id="img-path" accept="image/*"
                                            class="visually-hidden">
                                    </div>

                                </div>
                                <div>
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text"
                                        class="form-control form-control-dark @error('nome') is-invalid @enderror"
                                        name="nome" id="nome" value="{{ old('nome') }}">
                                    @error('nome')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="endereco" class="form-label">Endereço</label>
                                    <input type="text"
                                        class="form-control form-control-dark  @error('endereco') is-invalid @enderror"
                                        name="endereco" id="endereco" value="{{ old('endereco') }}">
                                    @error('endereco')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea class="form-control form-control-dark @error('descricao') is-invalid @enderror" name="descricao"
                                        id="descricao" rows="3">{{ old('descricao') }}</textarea>
                                    @error('descricao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h5 class="mt-4">Dados para login</h5>
                            <div class="row row-cols-3 g-3">
                                <div>
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text"
                                        class="form-control form-control-dark @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}">
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

                            <button type="submit" class="btn btn-warning mt-3"><i class="fas fa-save"></i>
                                Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function onFileChange() {

            let e = document.getElementById('img-path')
            let files = e.files || e.dataTransfer.files;
            if (!files.length) {
                return
            }
            createImage(files[0])
        }

        function createImage(file) {
            let reader = new FileReader()
            reader.onload = (e) => {
                document.getElementById('img-selecionada').src = e.target.result
            }
            reader.readAsDataURL(file)
        }

        document.getElementById('img-path').onchange = () => {
            onFileChange()
        }
    </script>
@endsection
