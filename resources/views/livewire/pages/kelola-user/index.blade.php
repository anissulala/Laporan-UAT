<div>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Daftar Akun Pengguna</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Tambah
                User</button>
        </div>
        <livewire:components.kelola-user.create />
        <livewire:components.kelola-user.create-password />

        <div class="bg-white p-4 rounded shadow-sm">
            @include('livewire.components.pesan')
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->userRoles as $role)
                                        <span>{{ $role->role->nama }}</span>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                        <button type="button" class="btn btn-warning btn-sm me-md-2"
                                            data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm me-md-2"
                                            data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                                            Hapus
                                        </button>
                                        <button class="btn btn-secondary btn-sm me-md-2" data-bs-toggle="modal"
                                            data-bs-target="#resetPasswordModal{{ $user->id }}">
                                            Reset Password
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            @livewire('components.kelola-user.edit', ['userId' => $user->id])
                            @livewire('components.kelola-user.delete')
                            @livewire('components.kelola-user.reset-password', ['userId' => $user->id])
                            @livewire('components.kelola-user.new-password')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>  
        {{ $users->links() }}
    </div>
</div>