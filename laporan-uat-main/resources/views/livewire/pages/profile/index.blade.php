<div>
    @include('livewire.components.pesan')
    <div class="container mt-4">
        <div class="bg-white p-4 rounded shadow-sm">
            <div class="position-relative">
                <h5>Detail Profil</h5>
    
                <div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" 
                                data-bs-target="#editProfileModal">Edit
                                Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#ubahPasswordModal">Ubah Password</a></li>
                    </ul>
                </div>
            </div>
           
            <livewire:components.profile.edit />
            <livewire:components.profile.ubah-password />

            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" wire:model="name" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" wire:model="email" disabled>
                </div>
                <div class="mb-3">
                    <label for="roles" class="form-label">Peran</label>
                    <input type="text" class="form-control" id="roles" value="{{ $roles }}" disabled>
                </div>
            </form>
        </div>
    </div>
</div>
