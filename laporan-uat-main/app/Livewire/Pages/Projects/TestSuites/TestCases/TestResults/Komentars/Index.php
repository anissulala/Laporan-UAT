<?php

namespace App\Livewire\Pages\Projects\TestSuites\TestCases\TestResults\Komentars;

use App\Models\Komentar;
use App\Models\MStatus;
use App\Models\TestCase;
use App\Models\TestResult;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['komentarUpdated' => 'render'];

    public $projectId, $testSuiteId, $testCaseId, $testResultId;
    public $test_case, $test_suite, $test_result, $users, $m_status, $komentar_count;

    public function mount($projectId, $testSuiteId, $testCaseId, $testResultId)
    {
        $this->projectId = $projectId;
        $this->testSuiteId = $testSuiteId;
        $this->testCaseId = $testCaseId;
        $this->testResultId = $testResultId;

        $this->test_result = TestResult::with(['userPenugasan', 'status'])->findOrFail($testResultId);
        $this->test_case = TestCase::findOrFail($testCaseId);
        $this->test_suite = $this->test_case->testSuite;

        $this->users = User::whereHas('userRoles.role', function ($query) {
            $query->where('nama', '!=', 'Admin');
        })->get();
        $this->m_status = MStatus::all();
    }

    public function render()
    {
        $this->komentar_count = Komentar::where('test_result_id', $this->testResultId)->count();

        $komentars = Komentar::with('user', 'status')
            ->where('test_result_id', $this->testResultId)
            ->paginate(8);

        return view('livewire.pages.projects.test-suites.test-cases.test-results.komentars.index', [
            'komentars' => $komentars,
            'test_case' => $this->test_case,
            'test_suite' => $this->test_suite,
            'test_result' => $this->test_result,
            'users' => $this->users,
            'm_status' => $this->m_status,
            'komentar_count' => $this->komentar_count,
        ]);
    }
}