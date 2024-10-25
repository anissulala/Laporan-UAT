<div>
    <div wire:ignore.self class="modal fade" id="deleteUserModal{{ $testSuiteId }}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $testSuiteId }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel{{ $testSuiteId }}">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tindakan ini akan menghapus data <strong>{{ $testSuiteName }}</strong> secara permanen. Apakah anda yakin ingin melanjutkan?</p> <!-- Gunakan nama test suite di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="deleteTestSuite">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
