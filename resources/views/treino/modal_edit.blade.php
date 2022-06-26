<!-- Modal -->
<div class="modal fade " id="model-edit" tabindex="-1" role="dialog" aria-labelledby="modelEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Treino</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('treino.update') }}" method="post">
                <div class="modal-body">

                    @csrf
                    @method('PUT')
                    <input type="hidden" name="edit_id" id="edit-id" value="{{ old('edit_id') }}">
                    <input type="hidden" name="id_aluno" value="{{ $idAluno }}">

                    <div class="mb-3">
                        <label for="edit-nome" class="form-label">Nome do treino</label>
                        <input type="text" value="{{ old('edit_nome') }}"
                            class="form-control @error('edit_nome') is-invalid @enderror" name="edit_nome"
                            id="edit-nome" required>
                        @error('edit_nome')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12 col-lg-6">
                            <label for="edit-series" class="form-label">Séries</label>
                            <input type="text" value="{{ old('edit_series') }}"
                                class="form-control @error('edit_series') is-invalid @enderror" name="edit_series"
                                id="edit-series" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                required>
                            @error('edit_series')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-lg-6">
                            <label for="edit-repeticoes" class="form-label">Repetições</label>
                            <input type="text" value="{{ old('edit_repeticoes') }}"
                                class="form-control @error('edit_repeticoes') is-invalid @enderror"
                                name="edit_repeticoes" id="edit-repeticoes" required>
                            @error('edit_repeticoes')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-lg-6">
                            <label for="edit-carga" class="form-label">Carga</label>
                            <input type="text" value="{{ old('edit_carga') }}"
                                class="form-control @error('edit_carga') is-invalid @enderror" name="edit_carga"
                                id="edit-carga">
                            @error('edit_carga')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-lg-6">
                            <label for="edit-video" class="form-label">Vídeo</label>
                            <input type="text" value="{{ old('edit_video') }}"
                                class="form-control @error('edit_video') is-invalid @enderror" name="edit_video"
                                id="edit-video">
                            @error('edit_video')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
