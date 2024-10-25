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
                        data-bs-target="#modalEdit-{{ $test_suite->id }}">Edit</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#deleteUserModal{{ $test_suite->id }}">Hapus</a></li>
            </ul>
        </div>
        <livewire:components.projects.test-suites.test-cases.test-suites-edit :test_suite_id="$testSuiteId" :project_id="$projectId" />
        <livewire:components.projects.test-suites.test-cases.test-suites-delete :test_suite_id="$testSuiteId" :project_id="$projectId" />

        <div class="container mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('project.index') }}"
                                style="text-decoration: none;">Project</a></li>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ $test_suite->kode }}</li>
                    </ol>
                </nav>
            </div>
            <!-- Detail Test Suite -->
            <div>
                <span class="breadcrumb-item active">#{{ $test_suite->kode }}</span>
                <h2>UAT {{ $test_suite->judul }}</h2>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <p><span class="label">PIC</span>: <span
                            class="value">{{ $test_suite->pic ? $test_suite->pic->name : '-' }}</span></p>
                    <p><span class="label">Scenario Writer</span>: <span
                            class="value">{{ $test_suite->scenario ? $test_suite->scenario->name : '-' }}</span></p>
                    <p><span class="label">Tester</span>: <span
                            class="value">{{ $test_suite->tester ? $test_suite->tester->name : '-' }}</span></p>
                </div>
                <div class="col-md-6">
                    <p><span class="label">Tanggal Mulai</span>: <span
                            class="value">{{ $test_suite->tgl_mulai ? \Carbon\Carbon::parse($test_suite->tgl_mulai)->format('d F Y') : '-' }}</span>
                    </p>
                    <p><span class="label">Tanggal Selesai</span>: <span
                            class="value">{{ $test_suite->tgl_selesai ? \Carbon\Carbon::parse($test_suite->tgl_selesai)->format('d F Y') : '-' }}</span>
                    </p>
                    <p><span class="label">Progress</span>: <span class="value">{{ $average_progress }}%</span></p>
                </div>
                <div>
                    <p><span class="label">URL Tiket</span>: <span class="value"><a href="{{ $test_suite->url }}"
                                target="_blank" rel="noopener noreferrer">{{ $test_suite->url }}</a></span></p>
                    <p><span class="label">Ref Tiket</span>: <span
                            class="value">{{ $test_suite->ref_tiket ? $test_suite->ref_tiket : '-' }}</span></p>
                    <p><span class="label">Perangkat</span>: <span
                            class="value">{{ $test_suite->perangkat ? $test_suite->perangkat : '-' }}</span></p>
                     <div class="d-flex">
                        <span class="label">Batasan</span>:<span 
                            class="value">{!! nl2br(e($test_suite->batasan)) !!}</span>
                    </div>
                </div>
            </div>

            <!-- Daftar Test Case -->
            <div class="container mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Test Case ({{ $test_cases_count }})</h5>
                    <div class="d-flex align-items-center ms-auto" style="margin-right: 10px;">
                        <input type="text" class="form-control" wire:model.live="search"
                            placeholder="Cari Test Case..." style="max-width: 250px;">
                    </div>
                    <button class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalCreateTestCase">Tambah Test Case</button>
                </div>

                <livewire:components.projects.test-suites.test-cases.create :project-id="$projectId" :test-suite-id="$testSuiteId" />

                <div class="bg-white p-4 rounded shadow-sm">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Judul Test Case</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($test_cases as $test_case)
                                    <tr wire:click="goToTestResults({{ $projectId }}, {{ $testSuiteId }}, {{ $test_case->id }})"
                                        style="cursor: pointer;">
                                        <td>{{ $test_case->kode }}</td>
                                        <td>{{ $test_case->judul }}</td>
                                        <td>
                                            @if ($test_case->progress == 100)
                                                <i class="fa-solid fa-circle me-2 text-secondary"></i>
                                                {{ $test_case->progress }}%
                                            @elseif($test_case->progress >= 50)
                                                <i class="fa-solid fa-circle-half-stroke me-2 text-secondary"></i>
                                                {{ $test_case->progress }}%
                                            @else
                                                <i class="fa-regular fa-circle me-2 text-secondary"></i>
                                                {{ $test_case->progress }}%
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $test_cases->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
