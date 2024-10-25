<div>
    <div wire:ignore.self class="modal fade" id="editTestResultModal{{ $test_result->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTestResultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTestResultModalLabel">Edit Hasil Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="harapan" class="form-label">Harapan</label>
                                <input type="text" class="form-control @error('harapan') is-invalid @enderror" id="harapan" wire:model="harapan" placeholder="Masukkan Harapan Hasil Test">
                                @error('harapan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
    
                            <div class="col-md-12 mb-3">
                                <label for="realisasi" class="form-label">Realisasi</label>
                                <input type="text" class="form-control @error('realisasi') is-invalid @enderror" id="realisasi" wire:model="realisasi" placeholder="Masukkan Realisasi Hasil Test">
                                @error('realisasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="user_id_penugasan" class="form-label">Penugasan</label>
                                <select class="form-control @error('user_id_penugasan') is-invalid @enderror" id="penugasan" wire:model="user_id_penugasan">
                                    <option value="">Pilih Penugasan</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $test_result->user_id_penugasan == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                    @error('user_id_penugasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </select>
                            </div>
    
                            <div class="col-md-6 mb-3">
                                <label for="k_status" class="form-label">Status</label>
                                <select class="form-control @error('k_status') is-invalid @enderror" id="status" wire:model="k_status">
                                    <option value="">Pilih Status</option>
                                    @foreach($m_status as $status)
                                        <option value="{{ $status->k_status }}" {{ $test_result->k_status == $status->k_status ? 'selected' : '' }}>
                                            {{ $status->label }}
                                        </option>
                                    @endforeach
                                    @error('k_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-link text-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary ms-2" wire:click.prevent="update">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
