<?php

namespace App\Livewire\Pages\Projects\TestSuites\TestCases\TestResults;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\TestResult;
use App\Models\TestCase;
use App\Models\MStatus;
use App\Models\User;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $projectId, $testSuiteId, $testCaseId, $test_case, $test_suite, $search;
    public $test_results_count, $m_status, $users;

    public function mount($projectId, $testSuiteId, $testCaseId)
    {
        $this->projectId = $projectId;
        $this->testSuiteId = $testSuiteId;
        $this->testCaseId = $testCaseId;

        $this->test_case = TestCase::findOrFail($testCaseId);
        $this->test_suite = $this->test_case->testSuite;
        $this->m_status = MStatus::all();
        $this->users = User::whereHas('userRoles.role', function ($query) {
            $query->where('nama', '!=', 'Admin');
        })->get();
    }

    // Mengambil data dengan pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $test_results = TestResult::with(['userPenugasan', 'status'])
            ->where('test_case_id', $this->testCaseId)
            ->search($this->search) // Memanggil scopeSearch dari model TestResult
            ->orderBy('kode', 'asc') //pengurutan
            ->paginate(5);

        $this->test_results_count = $test_results->total();

        return view('livewire.pages.projects.test-suites.test-cases.test-results.index', [
            'test_results' => $test_results,
            'test_case' => $this->test_case,
            'test_suite' => $this->test_suite,
            'm_status' => $this->m_status,
            'users' => $this->users,
        ]);
    }

    public function redirectToKomentars($testResultId)
    {
        // Gunakan properti $this-> untuk mengakses nilai dari mount
        return redirect()->route('komentar.index', [
            $this->projectId,
            $this->testSuiteId,
            $this->testCaseId,
            $testResultId
        ]);
    }
}
