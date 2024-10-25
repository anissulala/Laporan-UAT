<div>
    <div wire:ignore.self class="modal fade" id="modalEdit-{{ $test_suite->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Test Suite</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <!-- Judul -->
                            <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" wire:model="judul" required>
                            </div>

                            <!-- PIC dan Tanggal Mulai -->
                            <div class="col-md-6 mb-3">
                                <label for="pic" class="form-label">PIC</label>
                                <select class="form-select" id="pic" wire:model="user_id_pic" required>
                                    <option value="">Pilih PIC</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" wire:model="tgl_mulai" required>
                            </div>

                            <!-- Scenario Writer dan Tanggal Selesai -->
                            <div class="col-md-6 mb-3">
                                <label for="scenario_writer" class="form-label">Scenario Writer</label>
                                <select class="form-select" id="scenario_writer" wire:model="user_id_scenario" required>
                                    <option value="">Pilih Scenario Writer</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" wire:model="tgl_selesai" required>
                            </div>

                            <!-- Tester dan ref_tiket-->
                            <div class="col-md-6 mb-3">
                                <label for="tester" class="form-label">Tester</label>
                                <select class="form-select" id="tester" wire:model="user_id_tester" required>
                                    <option value="">Pilih Tester</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ref_tiket" class="form-label">Ref Tiket</label>
                                <input type="text" class="form-control" id="ref_tiket" wire:model="ref_tiket" placeholder="Masukkan Ref Tiket">
                            </div>

                            <!-- URL dan Perangkat -->
                            <div class="col-md-6 mb-3">
                                <label for="url" class="form-label">URL</label>
                                <input type="text" class="form-control" id="url" wire:model="url" placeholder="Masukkan URL">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="perangkat" class="form-label">Perangkat</label>
                                <input type="text" class="form-control" id="perangkat" wire:model="perangkat" placeholder="Masukkan Perangkat">
                            </div>

                            <!-- Batasan -->
                            <div class="col-md-12 mb-3">
                                <label for="batasan" class="form-label">Batasan</label>
                                <textarea class="form-control" id="batasan" wire:model="batasan" rows="3" placeholder="Tulis Batasan"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" wire:click.prevent="update">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>