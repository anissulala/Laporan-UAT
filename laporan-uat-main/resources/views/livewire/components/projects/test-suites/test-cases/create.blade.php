<div wire:ignore.self class="modal fade" id="modalCreateTestCase" tabindex="-1" aria-labelledby="modalCreateTestCaseLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTestCaseLabel">Tambah Test Case</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk membuat test case -->
                <form>
                    <!-- Judul -->
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" wire:model="judul" placeholder="Masukkan Judul Test Case">
                        @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Prakondisi -->
                    <div class="mb-3">
                        <label for="prakondisi" class="form-label">Prakondisi</label>
                        @foreach ($prakondisi as $index => $value)
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="bi bi-grip-vertical"></i></span>
                                <input type="text" class="form-control @error('prakondisi.*') is-invalid @enderror" wire:model="prakondisi.{{ $index }}" placeholder="Masukkan Prakondisi">
                                <span class="input-group-text"><i class="bi bi-trash3-fill" wire:click="removePrakondisi({{ $index }})"></i></span>
                            </div>
                        @endforeach
                        @error('prakondisi.*') <span class="text-danger">{{ $message }}</span> @enderror
                        <button type="button" class="btn btn-outline-primary" wire:click="addPrakondisi">Tambah Prakondisi</button>
                    </div>

                    <!-- Tahap Testing -->
                    <div class="mb-3">
                        <label for="tahap_testing" class="form-label">Tahap Testing</label>
                        @foreach ($tahap_testing as $index => $value)
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="bi bi-grip-vertical"></i></span>
                                <input type="text" class="form-control @error('tahap_testing.*') is-invalid @enderror" wire:model="tahap_testing.{{ $index }}" placeholder="Masukkan Tahap Testing">
                                <span class="input-group-text"><i class="bi bi-trash3-fill" wire:click="removeTahapTesting({{ $index }})"></i></span>
                            </div>
                        @endforeach
                        @error('tahap_testing.*') <span class="text-danger">{{ $message }}</span> @enderror
                        <button type="button" class="btn btn-outline-primary" wire:click.prevent="addTahapTesting">Tambah Tahap Testing</button>
                    </div>


                    <!-- Data Input -->
                    <div class="mb-3">
                        <label for="data_input" class="form-label">Data Input</label>
                        <textarea class="form-control @error('data_input') is-invalid @enderror" wire:model="data_input" rows="3" placeholder="Masukkan Data Input"></textarea>
                        @error('data_input') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="store">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>