<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases\TestResults;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\MStatus;
use App\Models\TestResult;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public $testCaseId;
    public $projectId;
    public $testSuiteId;
    public $testResultId;
    public $users;
    public $m_status;
    public $harapan;
    public $realisasi;
    public $user_id_penugasan;
    public $k_status;

    public function mount($testCaseId, $projectId, $testSuiteId)
    {
        $this->testCaseId = $testCaseId;
        $this->projectId = $projectId;
        $this->testSuiteId = $testSuiteId;

        $this->users = User::whereHas('userRoles.role', function ($query) {
            $query->where('nama', '!=', 'Admin');
        })->get();

        $this->m_status = MStatus::all();
    }

    public function store()
    {
        $validated = $this->validate([
            'user_id_penugasan' => ['required', Rule::exists('users', 'id')],
            'harapan' => 'required|string',
            'realisasi' => 'nullable|string',
            'k_status' => 'required',
        ], [
            'user_id_penugasan.required' => 'Penugasan harus diisi!',
            'harapan.required' => 'Harapan harus diisi!',
            'k_status.required' => 'Status harus diisi!',
        ]);

         // Mengambil nilai maksimum kode dari TestResult berdasarkan test_case_id
         $maxKode = TestResult::where('test_case_id', $this->testCaseId)
         ->selectRaw('MAX(CAST(SUBSTRING(kode, 3) AS UNSIGNED)) as max_kode')
         ->pluck('max_kode')
         ->first();

         // Generate kode baru
         $newCode = $maxKode
         ? 'HT' . str_pad($maxKode + 1, 2, '0', STR_PAD_LEFT)
         : 'HT01';

        // Create TestResult
        $testResult = TestResult::create([
            'kode' => $newCode,
            'test_case_id' => $this->testCaseId,
            'user_id_penugasan' => $validated['user_id_penugasan'],
            'harapan' => $validated['harapan'],
            'realisasi' => $validated['realisasi'],
            'k_status' => $validated['k_status'],
        ]);

        $this->testResultId = $testResult->id;

        
        session()->flash('success', 'Hasil Test berhasil ditambahkan!');
        return redirect()->route('komentar.index', [
            'projectId' => $this->projectId,
            'testSuiteId' => $this->testSuiteId,
            'testCaseId' => $this->testCaseId,
            'testResultId' => $this->testResultId,
        ]);
        
        $this->reset(['user_id_penugasan', 'harapan', 'realisasi', 'k_status']);
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-results.create', [
            'users' => $this->users,
            'm_status' => $this->m_status,
        ]);
    }
}
