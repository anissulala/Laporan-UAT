<div>
    @include('livewire.components.pesan')
    <!-- Judul Project di bagian atas kiri -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>Project ({{ $totalProjects }})</h5>
        <!-- Form Pencarian Geser ke Kanan -->
        <div class="d-flex align-items-center ms-auto" style="margin-right: 10px;">
            <input type="text" class="form-control" wire:model.live="search" placeholder="Cari project..."
                style="max-width: 250px;">
        </div>
        <!-- Tombol untuk memicu modal pop-up -->
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#tambahProjectModal">
            Tambah Project
        </button>
    </div>

    <livewire:components.projects.create wire:key="project-create-{{ uniqid() }}" />

    <!-- Card Database -->
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Project">
                                <a href="{{ route('testsuite.index', $project->id) }}" style="text-decoration: none;">
                                    <h5 class="card-title">{{ $project->nama }}</h5>
                                </a>
                            </div>

                            <!-- Requirment -->
                            <div class="requirement">
                                <p class="mb-2">Requirement</p>
                                <p class="mb-0">
                                    <span class="icon-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="black" class="bi bi-exclamation-circle me-2" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-1A6 6 0 1 1 8 2a6 6 0 0 1 0 12z" />
                                            <path
                                                d="M7.002 11a.998.998 0 1 1 2 0 .998.998 0 0 1-2 0zM7.93 4.519a.905.905 0 0 1 1.138 0c.217.154.307.4.307.683v3.761c0 .283-.09.53-.307.683a.905.905 0 0 1-1.138 0 .764.764 0 0 1-.307-.683V5.202c0-.283.09-.53.307-.683z" />
                                        </svg>
                                        <strong>{{ $project->belum_selesai_count }} Belum Selesai</strong>
                                    </span>
                                    <br>
                                    <span class="icon-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#818898" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-1A6 6 0 1 1 8 2a6 6 0 0 1 0 12z" />
                                            <path
                                                d="M10.97 6.97a.75.75 0 0 1 1.08 1.04l-3 3.5a.75.75 0 0 1-1.08 0l-1.5-1.5a.75.75 0 1 1 1.08-1.04l1.02 1.02 2.4-2.8z" />
                                        </svg>
                                        {{ $project->sudah_selesai_count }} Sudah Selesai
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        {{ $projects->links() }}
    </div>
</div>
