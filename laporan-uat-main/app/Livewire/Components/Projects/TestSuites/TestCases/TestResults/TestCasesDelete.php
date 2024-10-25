<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases\TestResults;

use App\Models\TestCase;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class TestCasesDelete extends Component
{
    public $testCaseId;
    public $testCaseName;

    public function mount($testCaseId)
    {
        $this->testCaseId = $testCaseId;
        $this->testCaseName = TestCase::findOrFail($this->testCaseId)->judul;
    }

    public function deleteTestCase()
    {
        $testCase = TestCase::findOrFail($this->testCaseId);

        if ($testCase->testResults()->count() > 0) {
            session()->flash('error', 'Test Case tidak bisa dihapus karena ada Test Result!');
            return redirect()->route('testresult.index', [
                'projectId' => $testCase->testSuite->project_id,
                'testSuiteId' => $testCase->test_suite_id,
                'testCaseId' => $testCase->id,
            ]);
        }

        $projectId = $testCase->testSuite->project_id;
        $testSuiteId = $testCase->test_suite_id;
        
        $testCase->delete();

        session()->flash('success', 'Test case berhasil dihapus!');
        return redirect()->route('testcase.index', [
            'projectId' => $projectId,
            'testSuiteId' => $testSuiteId
        ]);
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-results.test-cases-delete');
    }
}
