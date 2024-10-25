<div>
    <div wire:ignore.self class="modal fade" id="resetPasswordModal{{ $userId }}" tabindex="-1"
        aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password Akun {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mereset password akun <strong>{{ $user->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="resetPassword">Konfirmasi Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('resetPassword', (userId) => {
            $('#resetPasswordModal' + userId).modal('hide'); // Menutup modal untuk user yang tepat
        });
    </script>
@endpush