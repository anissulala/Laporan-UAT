<div>
    @include('livewire.components.pesan')
    <div class="container mt-5 position-relative">
        <div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#modalEditTestCase-{{ $test_case->id }}">Edit</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#deleteModalTestCase{{ $test_case->id }}">Hapus</a></li>
            </ul>
        </div>

        <livewire:components.projects.test-suites.test-cases.test-results.test-cases-edit :project-id="$projectId" :test-suite-id="$testSuiteId" :test-case-id="$testCaseId" />
        <livewire:components.projects.test-suites.test-cases.test-results.test-cases-delete :project-id="$projectId" :test-suite-id="$testSuiteId" :test-case-id="$testCaseId" />
    
        <div class="container mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('project.index') }}" style="text-decoration: none;">Project</a></li>
                        @if($test_suite->project)
                            <li class="breadcrumb-item">
                                <a href="{{ route('testsuite.index', $test_suite->project->id) }}" style="text-decoration: none;">
                                    {{ $test_suite->project->nama }}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item">Project Not Found</li>
                        @endif
    
                        @if($test_suite)
                            <li class="breadcrumb-item">
                                <a href="{{ route('testcase.index', [$test_suite->project->id, $test_suite->id]) }}" style="text-decoration: none;">
                                    {{ $test_suite->kode }}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item">Test Suite Not Found</li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{ $test_case->kode }}</li>
                    </ol>
                </nav>
            </div>
    
            <div>
                <span class="breadcrumb-item active">#{{ $test_case->kode }}</span>
                <h2>{{ $test_case->judul }}</h2>
            </div>
    
            <div class="row mt-4">
                <div class="col-md-6">
                    <h6>Prakondisi</h6>
                    @if($test_case->prakondisi && json_decode($test_case->prakondisi))
                        <ul>
                            @foreach(json_decode($test_case->prakondisi) as $prakondisi)
                                <li>{{ $prakondisi }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>-</p>
                    @endif
                </div>
    
                <div class="col-md-6">
                    <h6>Data Input</h6>
                    @if($test_case->data_input)
                        <p>{!! nl2br(e($test_case->data_input)) !!}</p>
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
    
            <div class="row mt-4">
                <div class="col-6">
                    <h6>Tahap Testing</h6>
                    @if($test_case->tahap_testing && json_decode($test_case->tahap_testing))
                        <ul>
                            @foreach(json_decode($test_case->tahap_testing) as $tahap)
                                <li>{{ $tahap }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
    
            <div class="container mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Hasil Test ({{ $test_results_count }})</h5>
                    <div class="d-flex align-items-center ms-auto" style="margin-right: 10px;">
                        <input wire:model.live="search" type="text" class="form-control" placeholder="Cari Hasil Test" style="max-width: 250px;">
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestResultModal">Tambah Hasil Test</button>
                </div>

                <livewire:components.projects.test-suites.test-cases.test-results.create :project-id="$projectId" :test-suite-id="$testSuiteId" :test-case-id="$testCaseId" />
                
                <div class="bg-white p-4 rounded shadow-sm">   
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Harapan</th>
                                    <th>Realisasi</th>
                                    <th>Penugasan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($test_results as $test_result)
                                    <tr wire:click="redirectToKomentars({{ $test_result->id }})" style="cursor: pointer;">
                                        <td>{{ $test_result->kode }}</td>
                                        <td>{{ $test_result->harapan }}</td>
                                        <td>{{ $test_result->realisasi }}</td>
                                        <td>{{ $test_result->userPenugasan->name }}</td>
                                        <td>{{ $test_result->status->label }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $test_results->links() }}
                </div>
            </div>
        </div>
    </div>    
</div>
