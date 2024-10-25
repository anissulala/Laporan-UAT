<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases\TestResults\Komentars;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\TestResult;
use App\Models\User;
use App\Models\MStatus;

#[Layout('components.layouts.app')]
class TestResultsEdit extends Component
{
    public $testResultId, $test_result;
    public $harapan, $realisasi, $user_id_penugasan, $k_status;
    public $users, $m_status;
    public $projectId, $testSuiteId, $testCaseId;

    public function mount($test_result_id, $projectId, $testSuiteId, $testCaseId)
    {
        $this->testResultId = $test_result_id;
        $this->test_result = TestResult::findOrFail($test_result_id);
        $this->harapan = $this->test_result->harapan;
        $this->realisasi = $this->test_result->realisasi;
        $this->user_id_penugasan = $this->test_result->user_id_penugasan;
        $this->k_status = $this->test_result->k_status;

        // Set ID yang dibutuhkan untuk route
        $this->projectId = $projectId;
        $this->testSuiteId = $testSuiteId;
        $this->testCaseId = $testCaseId;

        $this->users = User::whereHas('userRoles.role', function ($query) {
            $query->where('nama', '!=', 'Admin');
        })->get();

        $this->m_status = MStatus::all();
    }

    public function update()
    {
        $validated = $this->validate([
            'user_id_penugasan' => 'required|exists:users,id',
            'harapan' => 'required|string',
            'realisasi' => 'nullable|string',
            'k_status' => 'required',
        ]);

        $test_result = TestResult::findOrFail($this->testResultId);
        $test_result->update($validated);

        session()->flash('success', 'Test Result berhasil diubah');
        return redirect()->route('komentar.index', [
            'projectId' => $this->projectId,
            'testSuiteId' => $this->testSuiteId,
            'testCaseId' => $this->testCaseId,
            'testResultId' => $this->testResultId,
        ]);
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-results.komentars.test-results-edit');
    }
}
