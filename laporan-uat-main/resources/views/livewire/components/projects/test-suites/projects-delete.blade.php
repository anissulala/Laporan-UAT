<div>
    <div wire:ignore.self class="modal fade" id="deleteProjectModal{{ $projectId }}" tabindex="-1"
        aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProjectModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tindakan ini akan menghapus data <strong>{{ $projectnama }} </strong> secara permanen. Apakah anda yakin ingin melanjutkan?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteProject">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
