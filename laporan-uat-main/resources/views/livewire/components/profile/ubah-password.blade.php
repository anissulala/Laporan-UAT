<div>
    <div wire:ignore.self class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPasswordModalLabel">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Password lama</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" wire:model="old_password" required>
                            @error('old_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" wire:model="new_password" required>
                            @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="new_password_confirmation" wire:model="new_password_confirmation">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-link text-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary ms-2" wire:click.prevent="updatePassword">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
