@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h3 class="card-title mb-4 h4 fw-bold">Aluno: <span
                                class="text-info">{{ $aluno->user->name }}</span>
                        </h3>
                        <h4 class="card-title mb-3 h5">Treino</h4>
                        <form action="{{ route('treino.store', $aluno->id) }}" method="post">
                            @csrf
                            <div class="row row-cols-1 row-cols-lg-4 align-items-start gy-3">
                                <div>
                                    <div>
                                        <label for="dia" class="form-label">Dia da semana</label>
                                        <select class="form-select @error('semana_dia_id') is-invalid @enderror"
                                            name=" semana_dia_id" id="dia">
                                            @foreach ($diasDaSemana as $dia)
                                                <option value="{{ $dia->id }}"
                                                    @if ((request()->get('dia_da_semana') ?? 1) == $dia->id) selected @endif>
                                                    {{ $dia->dia }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('semana_dia_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="treino" class="form-label">Treino</label>
                                    <input type="text" class="form-control @error('treino') is-invalid @enderror"
                                        name="treino" id="treino" value="{{ old('treino') }}"
                                        placeholder="Nome do treino" required>
                                    @error('treino')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="series" class="form-label">Séries</label>
                                    <input type="number" min="0"
                                        class="form-control @error('series') is-invalid @enderror" name="series"
                                        id="series" value="{{ old('series') }}" placeholder="Séries"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                    @error('series')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="repeticoes" class="form-label">Repetições</label>
                                    <input type="text" min="0"
                                        class="form-control @error('repeticoes') is-invalid @enderror" name="repeticoes"
                                        id="repeticoes" value="{{ old('repeticoes') }}" placeholder="Repetições" required>
                                    @error('repeticoes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="carga" class="form-label">Carga</label>
                                    <input type="text" min="0"
                                        class="form-control @error('carga') is-invalid @enderror" name="carga"
                                        id="carga" value="{{ old('carga') }}" placeholder="Carga">
                                    @error('carga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="video" class="form-label">Vídeo</label>
                                    <input type="text" class="form-control @error('video') is-invalid @enderror"
                                        name="video" id="video" value="{{ old('video') }}"
                                        placeholder="https://youtube.com/">
                                    @error('video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="" class="form-label w-100 opacity-0">Adicionar</label>
                                    <button type="submit" class="btn btn-warning d-block w-100"><i class="fas fa-plus"></i>
                                        Adicionar</button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <div class="table-responsive mt-3">
                            <table class="table table-dark table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Treino</th>
                                        <th>Séries</th>
                                        <th>Repetições</th>
                                        <th>Carga</th>
                                        <th>Vídeo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($treinosParaDiaSelecionado as $item)
                                        <tr>
                                            <td>{{ $item->treino }}</td>
                                            <td>{{ $item->series }}</td>
                                            <td>{{ $item->repeticoes }}</td>
                                            <td>{{ $item->carga }}</td>
                                            <td>{{ $item->video }}</td>
                                            <td class="col-2 text-truncate">
                                                <button type="button" class="btn btn-primary btn-sm px-3"
                                                    data-bs-toggle="modal" data-bs-target="#model-edit"
                                                    onclick='setDadosEditTreino(`<?= $item ?>`)'>
                                                    Editar
                                                </button>

                                                <form class="d-inline-block"
                                                    action="{{ route('treino.destroy', $item->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm px-3">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (count($treinosParaDiaSelecionado) == 0)
                                <div class="alert text-muted">
                                    Não há treinos para o dia selecionado.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('treino.modal_edit', ['idAluno' => $aluno->user_id])
    <button type="button" id="model-edit-btn" class="btn btn-primary btn-lg visually-hidden" data-bs-toggle="modal"
        data-bs-target="#model-edit">
    </button>
    @if ($errors->first('edit_nome') || $errors->first('edit_series') || $errors->first('edit_repeticoes'))
        <script>
            document.getElementById('model-edit-btn').click()
        </script>
    @endif
    <script>
        // redireciona ao selecionar dia da semana
        document.getElementById('dia').onchange = function() {
            let el = document.getElementById('dia');
            let idSeleconado = el.options[el.selectedIndex].value;
            window.location.href = '{{ route('treino.create', $aluno->id) }}?dia_da_semana=' + idSeleconado
        }


        function setDadosEditTreino(data) {
            data = JSON.parse(data)
            console.log(data)
            document.getElementById('edit-nome').value = data.treino
            document.getElementById('edit-series').value = data.series
            document.getElementById('edit-repeticoes').value = data.repeticoes
            document.getElementById('edit-carga').value = data.carga
            document.getElementById('edit-video').value = data.video
            document.getElementById('edit-id').value = data.id
            cancelarEdit()
        }

        function cancelarEdit() {
            for (let int = 0; int <= 30; int++) {
                for (let i in document.getElementsByClassName('is-invalid')) {
                    document.getElementsByClassName('is-invalid')[i].className = 'form-control'
                }
            }
        }
    </script>
@endsection
