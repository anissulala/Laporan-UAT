<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases\TestResults\Komentars;

use App\Models\TestResult;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class TestResultsDelete extends Component
{
    public $testResultId;
    public $projectId;
    public $testSuiteId;
    public $testCaseId;
    public $test_result;

    public function mount($test_result_id)
    {
        $this->testResultId = $test_result_id;
        $this->test_result = TestResult::findOrFail($test_result_id);
    }

    public function deleteTestResult()
    {
        $test_result = TestResult::findOrFail($this->testResultId);

        if ($test_result->komentar()->count() > 0) {
            return redirect()->route('komentar.index', [
                'projectId' => $test_result->testcase->testsuite->project->id,
                'testSuiteId' => $test_result->testcase->testsuite->id,
                'testCaseId' => $test_result->testcase->id,
                'testResultId' => $test_result->id
            ])->with('error', 'Hasil Test tidak bisa dihapus karena ada komentar yang terkait!');
        }

        $test_result->delete();

        return redirect()->route('testresult.index', [
            'projectId' => $test_result->testcase->testsuite->project->id,
            'testSuiteId' => $test_result->testcase->testsuite->id,
            'testCaseId' => $test_result->testcase->id,
            'testResultId' => $test_result->id
        ])->with('success', 'Hasil Test berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-results.komentars.test-results-delete');
    }
}
