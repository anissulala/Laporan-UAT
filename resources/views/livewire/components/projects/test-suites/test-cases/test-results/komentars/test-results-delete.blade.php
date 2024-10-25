<div>
    <div wire:ignore.self class="modal fade" id="deleteTestResultModal{{ $test_result->id }}" tabindex="-1"
        aria-labelledby="deleteTestResultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTestResultModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tindakan ini akan menghapus data hasil test dengan kode {{ $test_result->kode }} secara permanen.
                        Apakah Anda yakin ingin melanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-secondary" wire:click.prevent="deleteTestResult">Hapus</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
