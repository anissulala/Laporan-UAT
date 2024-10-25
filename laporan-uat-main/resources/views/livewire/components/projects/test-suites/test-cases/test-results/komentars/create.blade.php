<div>
    <!-- Modal Tambah Komentar -->
    <div wire:ignore.self class="modal fade" id="tambahKomentarModal" tabindex="-1" aria-labelledby="tambahKomentarLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKomentarLabel">Tambah Komentar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="penugasan" class="form-label">Penugasan</label>
                                <select class="form-select" wire:model="user_id_penugasan">
                                    <option value="">Pilih Penugasan</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id_penugasan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" wire:model="k_status">
                                    <option value="">Pilih Status</option>
                                    @foreach ($m_status as $status)
                                        <option value="{{ $status->k_status }}">{{ $status->label }}</option>
                                    @endforeach
                                </select>
                                @error('k_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="komentar" class="form-label">Komentar</label>
                            <textarea class="form-control" wire:model="komentar" rows="3" placeholder="Masukkan Komentar"></textarea>
                            @error('komentar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" wire:click.prevent ="store">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
