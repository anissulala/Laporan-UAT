<div>
    <div wire:ignore.self class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="roles" class="form-label">Roles</label>
                            <div>
                                @foreach($availableRoles as $role)
                                    <div>
                                        <input type="checkbox" wire:model="roles" value="{{ $role['id'] }}" id="role_{{ $role['id'] }}">
                                        <label for="role_{{ $role['id'] }}">{{ $role['nama'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('roles')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-link text-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary ms-2" wire:click.prevent="updateUser">Simpan</button>
                </div>
            </div>
        </div>
    </div>    
</div>
