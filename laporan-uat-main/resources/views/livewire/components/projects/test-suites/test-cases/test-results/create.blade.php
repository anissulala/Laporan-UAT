<div>
    <div wire:ignore.self class="modal fade" id="addTestResultModal" tabindex="-1" aria-labelledby="addTestResultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTestResultModalLabel">Tambah Hasil Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="harapan" class="form-label">Harapan</label>
                                <input type="text" wire:model="harapan" class="form-control @error('harapan') is-invalid @enderror" id="harapan" placeholder="Masukkan Harapan Hasil Test">
                                @error('harapan') 
                                <div class="text-danger">
                                    {{ $message }}
                                </div> 
                                @enderror
                            </div>
    
                            <div class="col-md-12 mb-3">
                                <label for="realisasi" class="form-label">Realisasi</label>
                                <input type="text" wire:model="realisasi" class="form-control" id="realisasi" placeholder="Masukkan Realisasi Hasil Test">
                            </div>
    
                            <div class="col-md-6 mb-3">
                                <label for="penugasan" class="form-label">Penugasan</label>
                                <select wire:model="user_id_penugasan" class="form-select @error('user_id_penugasan') is-invalid @enderror" id="penugasan">
                                    <option value="">Pilih Penugasan</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id_penugasan') 
                                <div class="text-danger">
                                    {{ $message }}
                                </div> 
                                @enderror
                            </div>
    
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select wire:model="k_status" class="form-select @error('k_status') is-invalid @enderror" id="status">
                                    <option value="">Pilih Status</option>
                                    @foreach($m_status as $status)
                                        <option value="{{ $status->k_status }}">{{ $status->label }}</option>
                                    @endforeach
                                </select>
                                @error('k_status') 
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-link text-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary ms-2" wire:click.prevent="store">Tambah</button>
                </div>
            </div>
        </div>
    </div>    
</div>
