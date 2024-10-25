<div wire:ignore.self class="modal fade" id="newPasswordModal" tabindex="-1" aria-labelledby="newPasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPasswordModalLabel">Password Baru untuk {{ $userName }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Password baru yang dihasilkan untuk <strong>{{ $userName }}</strong> adalah: <br>
                <h4>{{ $newPassword }}</h4>
                <p>Silakan catat password ini karena tidak akan ditampilkan lagi.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('openNewPasswordModal', () => {
            $('#newPasswordModal').modal('show');
        });
    </script>
@endpush