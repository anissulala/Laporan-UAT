<div>
    @include('livewire.components.pesan')
    @if ($project)
        <!-- Detail Project -->
        <div class="container mt-1 position-relative">
            <!-- Dropdown Menu untuk Edit dan Hapus -->
            <div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#editProjectModal{{ $project->id }}">Edit</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#deleteProjectModal{{ $project->id }}">Hapus</a></li>
                </ul>
            </div>

            @livewire('components.projects.test-suites.projects-edit', ['projectId' => $projectId])
            @livewire('components.projects.test-suites.projects-delete', ['projectId' => $projectId])

            <!-- Breadcrumb untuk navigasi -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('project.index') }}"
                            style="text-decoration: none;">Project</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $project->nama }}</li>
                </ol>
            </nav>

            <!-- Menampilkan logo dan nama project -->
            <div class="d-flex align-items-center mb-4">
                <!-- Gambar/logo project -->
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Project" class="me-3"
                    style="width: 100px; height: 100px;">
                <!-- Nama project -->
                <h1>{{ $project->nama }}</h1>
            </div>

            <!-- Memisahkan deskripsi menjadi beberapa paragraf -->
            <div class="project-description mt-4" style="max-width: 900px;">
                @foreach (explode("\n", $project->deskripsi) as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

        </div>
    @endif

    {{-- Daftar Test SUite --}}
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Test Suite Saya ({{ $test_suite_count }})</h5>
            <div class="d-flex align-items-center ms-auto" style="margin-right: 10px;">
                <input type="text" class="form-control" wire:model.live="search" placeholder="Cari Test Suite..."
                    style="max-width: 250px;">
            </div>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Test
                Suite</button>
        </div>
        <livewire:components.projects.test-suites.create :projectId="$projectId" />

        <div class="bg-white p-4 rounded shadow-sm">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Project</th>
                            <th>Judul Test Suite</th>
                            <th>Jumlah Test Case</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($test_suite as $suite)
                            <tr onclick="window.location='{{ route('testcase.index', [$suite->project->id, $suite->id]) }}'"
                                style="cursor: pointer;">
                                <td>{{ $suite->kode }}</td>
                                <td>{{ $suite->project ? $suite->project->nama : '-' }}</td>
                                <td>{{ $suite->judul }}</td>
                                <td>{{ $suite->testCases->count() }}</td>
                                <td>
                                    @if ($suite->progress == 100)
                                        <i class="fa-solid fa-circle me-2 text-secondary"></i> {{ $suite->progress }}%
                                    @elseif($suite->progress >= 50)
                                        <i class="fa-solid fa-circle-half-stroke me-2 text-secondary"></i>
                                        {{ $suite->progress }}%
                                    @else
                                        <i class="fa-regular fa-circle me-2 text-secondary"></i>
                                        {{ $suite->progress }}%
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $test_suite->links() }}
        </div>
    </div>
</div>
