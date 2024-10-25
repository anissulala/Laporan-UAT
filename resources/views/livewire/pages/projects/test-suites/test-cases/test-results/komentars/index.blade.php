<div>
    @include('livewire.components.pesan')
    <div class="container mt-5 position-relative">
        <!-- Dropdown Menu untuk Edit dan Hapus -->
        <div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#editTestResultModal{{ $test_result->id }}">Edit</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#deleteTestResultModal{{ $test_result->id }}">Hapus</a></li>
            </ul>
        </div>

        <livewire:components.projects.test-suites.test-cases.test-results.komentars.test-results-edit :project-id="$projectId" :test-suite-id="$testSuiteId" :test-case-id="$testCaseId" :test_result_id="$testResultId" />
        <livewire:components.projects.test-suites.test-cases.test-results.komentars.test-results-delete :project-id="$projectId" :test-suite-id="$testSuiteId" :test-case-id="$testCaseId" :test_result_id="$testResultId" />

        <!-- Breadcrumb untuk navigasi -->
        <div class="container mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('project.index') }}"
                                style="text-decoration: none;">Project</a></li>
                        <!-- Breadcrumb for the specific Project -->
                        @if ($test_suite->project)
                            <li class="breadcrumb-item">
                                <a href="{{ route('testsuite.index', $test_suite->project->id) }}"
                                    style="text-decoration: none;">
                                    {{ $test_suite->project->nama }}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item">Project Not Found</li>
                        @endif

                        <!-- Breadcrumb for the specific Test Suite -->
                        @if ($test_suite)
                            <li class="breadcrumb-item">
                                <a href="{{ route('testcase.index', [$test_suite->project->id, $test_suite->id]) }}"
                                    style="text-decoration: none;">
                                    {{ $test_suite->kode }}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item">Test Suite Not Found</li>
                        @endif

                        @if ($test_case)
                            <li class="breadcrumb-item">
                                <a href="{{ route('testresult.index', [$projectId, $testSuiteId, $testCaseId]) }}"
                                    style="text-decoration: none;">
                                    {{ $test_result->testCase->kode }}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item">Test Case Not Found</li>
                        @endif

                        <li class="breadcrumb-item active" aria-current="page">{{ $test_result->kode }}</li>
                    </ol>
                </nav>
            </div>

            <!-- Detail Test Result -->
            <div>
                <span class="breadcrumb-item active">#{{ $test_result->kode }}</span>
                <h2>{{ $test_result->harapan }}</h2>
            </div>

            <!-- Informasi Detail Test Result -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <p><span class="label">Penugasan</span>: <span
                            class="value">{{ $test_result->userPenugasan ? $test_result->userPenugasan->name : '-' }}</span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><span class="label">Status</span>: <span
                            class="value">{{ $test_result->status ? $test_result->status->label : '-' }}</span></p>
                </div>
                <div class="col-md-12">
                    <p><span class="label">Realisasi</span>: <span
                            class="value">{{ $test_result->realisasi ? $test_result->realisasi : '-' }}</span></p>
                </div>
            </div>
        </div>

        <!-- Judul komentar di bagian atas kiri -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Komentar ({{ $komentar_count }})</h4>
            <!-- Tombol untuk memicu modal pop-up -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                data-bs-target="#tambahKomentarModal">
                Tambah Komentar
            </button>
        </div>

        @livewire('components.projects.test-suites.test-cases.test-results.komentars.create', ['testResultId' => $testResultId, 'projectId' => $projectId, 'testSuiteId' => $testSuiteId, 'testCaseId' => $testCaseId])

        <!-- Card Database -->
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
                @foreach ($komentars as $komentar)
                    <div class="col-md-11">
                        <!-- Ubah ukuran kolom -->
                        <div class="card shadow-sm custom-card">
                            <!-- Dropdown Menu untuk Edit dan Hapus -->
                            <div class="dropdown position-relative">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="position: absolute; top: 10px; right: 10px;">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#editKomentarModal{{ $komentar->id }}">Edit</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteKomentarModal{{ $komentar->id }}">Hapus</a></li>
                                </ul>
                            </div>

                            @if ($komentar)
                                @livewire('components.projects.test-suites.test-cases.test-results.komentars.edit', ['testResultId' => $testResultId, 'komentarId' => $komentar->id], key($komentar->id))
                                @livewire('components.projects.test-suites.test-cases.test-results.komentars.delete', ['testResultId' => $testResultId, 'komentarId' => $komentar->id], key($komentar->id))
                            @endif


                            <div class="card-body d-flex flex-column">
                                <!-- Header Komentar -->
                                <div class="d-flex justify-content-between">
                                    <!-- Profil dan Nama -->
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/img/profile.jpg') }}" alt="Foto Profil"
                                            class="rounded-circle" width="40" height="40"
                                            style="margin-top: -7px;">
                                        <div class="ms-2">
                                            <h6 class="mb-0">{{ $komentar->user->name }}</h6>
                                            <small class="text-muted">
                                                {{ $komentar->tgl_komentar ? \Carbon\Carbon::parse($komentar->tgl_komentar)->format('d F Y') : 'Tanggal Tidak Diketahui' }}
                                            </small>
                                        </div>
                                    </div>
                                    <!-- Penugasan dan Status -->
                                    <div class="text-end">
                                        <small class="d-block">
                                            Penugasan diubah dari {{ $komentar->old_assignee ?? 'Tidak diketahui' }} ke
                                            {{ $komentar->new_assignee ?? 'Tidak diketahui' }}
                                        </small>
                                        <small class="text-muted">
                                            Status diubah dari {{ $komentar->old_status ?? 'Tidak diketahui' }} ke
                                            {{ $komentar->new_status ?? 'Tidak diketahui' }}
                                        </small>
                                    </div>
                                </div>

                                <!-- Isi Komentar -->
                                <p class="card-text mt-3">{{ $komentar->komentar }}</p>

                                <!-- Informasi Diedit -->
                                @if ($komentar->is_edited)
                                    <div class="text-end">
                                        <small class="text-muted">Diedit</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="justify-content-end mt-4 me-5 ms-5">
                {{ $komentars->links() }}
            </div>
        </div>
    </div>
</div>
