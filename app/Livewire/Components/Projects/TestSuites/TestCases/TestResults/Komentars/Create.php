<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases\TestResults\Komentars;

use App\Models\Komentar;
use App\Models\MStatus;
use App\Models\TestResult;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public $testResultId;
    public $user_id_penugasan;
    public $k_status;
    public $komentar;
    public $users;
    public $m_status;
    public $projectId, $testSuiteId, $testCaseId;


    public function mount($testResultId, $projectId, $testSuiteId, $testCaseId)
    {
        $this->testResultId = $testResultId;
        $this->users = User::all();
        $this->m_status = MStatus::all();

        // Set ID yang dibutuhkan untuk route
        $this->projectId = $projectId;
        $this->testSuiteId = $testSuiteId;
        $this->testCaseId = $testCaseId;
    }

    public function store()
    {
        $validated = $this->validate([
            'user_id_penugasan' => 'required|exists:users,id', // harus valid dalam tabel users
            'k_status' => 'required|exists:m_status,k_status', //  harus valid dalam tabel m_status
            'komentar' => 'required|string',
        ], [
            'user_id_penugasan.required' => 'Penugasan harus diisi!',
            'k_status.required' => 'Status harus diisi!',
            'komentar.required' => 'Komentar harus diisi!',
        ]);

        // Ambil data test result terkait
        $testResult = TestResult::findOrFail($this->testResultId);

        // Ambil komentar terakhir
        $lastKomentar = Komentar::where('test_result_id', $this->testResultId)->latest()->first();

        // Ambil penugasan dan status lama
        $oldAssignee = $lastKomentar ? User::find($lastKomentar->user_id_penugasan)->name : User::find($testResult->user_id_penugasan)->name;
        $oldStatus = $lastKomentar ? MStatus::find($lastKomentar->k_status)->label : MStatus::find($testResult->k_status)->label;

        // Ambil penugasan dan status baru dari form
        $newAssignee = User::find($this->user_id_penugasan)->name ?? 'Tidak diketahui';
        $newStatus = MStatus::find($this->k_status)->label ?? 'Tidak diketahui';

        // Simpan komentar baru
        Komentar::create([
            'test_result_id' => $this->testResultId,
            'user_id_penugasan' => $this->user_id_penugasan,
            'k_status' => $this->k_status,
            'komentar' => $this->komentar,
            'tgl_komentar' => Carbon::now(),
            'old_assignee' => $oldAssignee,
            'new_assignee' => $newAssignee,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
        ]);

        // Update status pada test result
        $testResult->update([
            'k_status' => $this->k_status,
        ]);

        // Reset input
        $this->reset(['user_id_penugasan', 'k_status', 'komentar']);

        session()->flash('success', 'Komentar berhasil dibuat!');
        return redirect()->route('komentar.index', [
            'projectId' => $this->projectId, // Menggunakan projectId dari mount
            'testSuiteId' => $this->testSuiteId, // Menggunakan testSuiteId dari mount
            'testCaseId' => $this->testCaseId, // Menggunakan testCaseId dari mount
            'testResultId' => $this->testResultId,
        ]);
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-results.komentars.create');
    }
}
