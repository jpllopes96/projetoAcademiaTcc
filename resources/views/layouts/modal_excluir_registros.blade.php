<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

            <form action="" method="post" id="form-delete">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-warning"></i> Excluir registro
                    </h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Não
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-trash-alt"></i> Sim
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
