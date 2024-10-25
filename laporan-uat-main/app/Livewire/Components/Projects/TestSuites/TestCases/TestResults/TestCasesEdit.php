<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases\TestResults;

use App\Models\TestCase;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class TestCasesEdit extends Component
{
    public $testCaseId;
    public $judul;
    public $prakondisi = [];
    public $tahap_testing = [];
    public $data_input;
    public $test_case;
    public $test_suite_id;
    public $projectId;
    
    public function mount($testCaseId)
    {
        $testCase = TestCase::findOrFail($testCaseId);

        // Menyimpan data ke properti
        $this->test_case = $testCase; // Menyimpan model ke dalam properti
        $this->testCaseId = $testCase->id;
        $this->judul = $testCase->judul;
        $this->prakondisi = json_decode($testCase->prakondisi, true) ?? [];
        $this->tahap_testing = json_decode($testCase->tahap_testing, true) ?? [];
        $this->data_input = $testCase->data_input;
        $this->test_suite_id = $testCase->test_suite_id; // Asumsi kolom ini ada di model TestCase
        $this->projectId = $testCase->testSuite->project_id;
    }

    public function addPrakondisi()
    {
        $this->prakondisi[] = ''; // Tambah input baru
    }

    public function addTahapTesting()
    {
        $this->tahap_testing[] = ''; // Tambah input baru
    }

    public function removePrakondisi($index)
    {
        unset($this->prakondisi[$index]);
        $this->prakondisi = array_values($this->prakondisi); // Reset indeks array
    }

    public function removeTahapTesting($index)
    {
        unset($this->tahap_testing[$index]);
        $this->tahap_testing = array_values($this->tahap_testing); // Reset indeks array
    }

    public function update()
    {
        $validatedData = $this->validate([
            'judul' => 'required|string|max:255',
            'prakondisi' => 'required|array|min:1',
            'prakondisi.*' => 'required|string|max:255',
            'tahap_testing' => 'required|array|min:1',
            'tahap_testing.*' => 'required|string|max:255',
            'data_input' => 'required|string',
        ]);

        $testCase = TestCase::findOrFail($this->testCaseId);

        $testCase->update([
            'judul' => $this->judul,
            'prakondisi' => json_encode($this->prakondisi),
            'tahap_testing' => json_encode($this->tahap_testing),
            'data_input' => $this->data_input,
        ]);

        session()->flash('success', 'Test Case Berhasil di Update');
        return redirect()->route('testresult.index', [
            'projectId' => $this->projectId,
            'testSuiteId' => $this->test_suite_id,
            'testCaseId' => $testCase->id,
        ]);
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-results.test-cases-edit');
    }
}