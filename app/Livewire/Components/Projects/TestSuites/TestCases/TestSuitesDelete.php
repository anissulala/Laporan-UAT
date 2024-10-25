<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases;

use Livewire\Component;
use App\Models\TestSuite;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class TestSuitesDelete extends Component
{
    public $testSuiteId;
    public $testSuiteName; // Tambahkan properti untuk menyimpan nama test suite

    public function mount($testSuiteId)
    {
        $this->testSuiteId = $testSuiteId;
        // Ambil nama test suite berdasarkan ID
        $this->testSuiteName = TestSuite::findOrFail($this->testSuiteId)->judul; // Ganti 'name' sesuai dengan nama kolom di database
    }

    public function deleteTestSuite()
    {
        $testSuite = TestSuite::findOrFail($this->testSuiteId);

        if ($testSuite->testCases()->count() > 0) {
            session()->flash('error', 'Test Suite tidak bisa dihapus karena ada test Case!');
            return redirect()->route('testcase.index', ['projectId' => $testSuite->project_id, 'testSuiteId' => $testSuite->id]);
        }

        $projectId = $testSuite->project_id;
        $testSuite->delete();

        session()->flash('success', 'Test Suite berhasil dihapus!');
        return redirect()->route('testsuite.index', ['projectId' => $projectId]);
    }
    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-suites-delete');
    }
}