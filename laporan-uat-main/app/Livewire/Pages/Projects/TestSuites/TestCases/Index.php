<?php

namespace App\Livewire\Pages\Projects\TestSuites\TestCases;

use App\Models\TestSuite;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['testSuiteUpdate' => 'render', 'testSuiteDelete' => 'render', 'testCaseCreate' => 'render'];

    public $projectId;
    public $testSuiteId;
    public $search;

    public function mount($projectId, $testSuiteId)
    {
        $this->projectId = $projectId;
        $this->testSuiteId = $testSuiteId;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function goToTestResults($projectId, $testSuiteId, $testCaseId)
    {
        return redirect()->route('testresult.index', [$projectId, $testSuiteId, $testCaseId]);
    }
    public function render()
    {
        $test_suite = TestSuite::where('project_id', $this->projectId)
            ->findOrFail($this->testSuiteId);

        $query = $test_suite->testCases();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('kode', 'like', "%{$this->search}%")
                    ->orWhere('judul', 'like', "%{$this->search}%");
            });
        }

        $test_cases_count = $query->count();
        $test_cases = $query->paginate(5);

        $totalProgress = $query->sum('progress');
        $average_progress = $test_cases_count > 0 ? (int) ($totalProgress / $test_cases_count) : 0;

        $users = User::all();

        return view('livewire.pages.projects.test-suites.test-cases.index', [
            'test_suite' => $test_suite,
            'test_cases' => $test_cases,
            'test_cases_count' => $test_cases_count,
            'users' => $users,
            'average_progress' => $average_progress,
        ]);
    }
}
