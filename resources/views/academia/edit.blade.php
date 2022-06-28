@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-header">Editar academia</div>
                    <div class="card-body">
                        <form action="{{ route('academia.update', $academia->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row row-cols-1 row-cols-lg-3 g-3">
                                <div>
                                    <div class="mb-2">Foto da academia</div>
                                    <div class="d-flex">
                                        <img src="{{ asset($academia->img_path) }}" id="img-selecionada" width="100"
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
                                        name="nome" id="nome" value="{{ old('nome', $academia->user->name) }}">
                                    @error('nome')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="endereco" class="form-label">Endereço</label>
                                    <input type="text"
                                        class="form-control form-control-dark  @error('endereco') is-invalid @enderror"
                                        name="endereco" id="endereco" value="{{ old('endereco', $academia->endereco) }}">
                                    @error('endereco')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea class="form-control form-control-dark @error('descricao') is-invalid @enderror" name="descricao"
                                        id="descricao" rows="3">{{ old('descricao', $academia->descricao) }}</textarea>
                                    @error('descricao')
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
