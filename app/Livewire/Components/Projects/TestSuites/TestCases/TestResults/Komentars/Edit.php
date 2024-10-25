<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases\TestResults\Komentars;

use App\Models\Komentar;
use App\Models\MStatus;
use App\Models\User;
use App\Models\Status;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Edit extends Component
{
    public $komentar; // Untuk objek Komentar
    public $komentarText; // Untuk teks komentar
    public $user_id_penugasan;
    public $k_status;
    public $users;
    public $m_status;

    public function mount($komentarId)
    {
        $this->komentar = Komentar::find($komentarId);

        if ($this->komentar) {
            $this->komentarText = $this->komentar->komentar;
            $this->user_id_penugasan = $this->komentar->user_id_penugasan; 
            $this->k_status = $this->komentar->k_status;

            // Muat data user dan status
            $this->users = User::all();
            $this->m_status = MStatus::all();
        } else {
            session()->flash('error', 'Komentar tidak ditemukan.');
        }
    }

    public function updateKomentar()
    {
        $this->validate([
            'komentarText' => 'required|min:3',
        ], [
            'komentarText.required' => 'Komentar tidak boleh kosong.',
        ]);

        if ($this->komentar) {
            $this->komentar->update([
                'komentar' => $this->komentarText,
                'user_id_penugasan' => $this->user_id_penugasan,
                'k_status' => $this->k_status,
                'tgl_komentar' => Carbon::now(),
                'is_edited' => true,

            ]);

            session()->flash('success', 'Komentar berhasil diperbarui.');
            return redirect()->route('komentar.index', [
                'projectId' => $this->komentar->testResult->testcase->testsuite->project->id,
                'testSuiteId' => $this->komentar->testResult->testcase->testsuite->id,
                'testCaseId' => $this->komentar->testResult->testcase->id,
                'testResultId' => $this->komentar->test_result_id,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-results.komentars.edit');
    }
}
