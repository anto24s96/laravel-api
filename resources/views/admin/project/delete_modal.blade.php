<!-- Modal -->
<div class="modal fade" id="modal_post_delete-{{ $project->id }}" tabindex="-1" aria-labelledby="modal_post_delete"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_post_delete">Conferma cancellazione</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h3 id="custom-message">Sei sicuro di cancellare <span class="fst-italic">"{{ $project->name }}"</span>
                    ?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-uppercase fw-bolder"
                    data-bs-dismiss="modal">Chiudi</button>

                <div class="mx-1">
                    <form action="{{ route('admin.project.destroy', $project->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"class="btn btn-danger fw-bolder text-uppercase">Delete
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
