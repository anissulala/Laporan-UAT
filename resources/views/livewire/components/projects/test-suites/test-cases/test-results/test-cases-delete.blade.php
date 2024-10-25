<div>
    <div wire:ignore.self class="modal fade" id="deleteModalTestCase{{ $testCaseId }}" tabindex="-1" aria-labelledby="deleteModalTestCaseLabel{{ $testCaseId }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalTestCaseLabel{{ $testCaseId }}">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tindakan ini akan menghapus data <strong>{{ $testCaseName }}</strong> secara permanen. Apakah anda yakin ingin melanjutkan?</p> <!-- Gunakan nama test suite di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="deleteTestCase">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>