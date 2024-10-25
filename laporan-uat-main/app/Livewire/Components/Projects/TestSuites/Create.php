<?php
namespace App\Livewire\Components\Projects\TestSuites;

use App\Models\User;
use Livewire\Component;
use App\Models\TestSuite;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]

class Create extends Component
{
    public $users;
    public $projectId;
    public $judul;
    public $user_id_pic;
    public $tgl_mulai;
    public $tgl_selesai;
    public $user_id_scenario;
    public $user_id_tester;
    public $ref_tiket;
    public $url;
    public $perangkat;
    public $batasan;

    public function mount()
    {
        $this->users = User::whereHas('userRoles.role', function ($query) {
            $query->where('nama', '!=', 'Admin');
        })->get();
    }

    public function store()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'user_id_pic' => 'required|exists:users,id',
            'tgl_mulai' => 'required|date|before_or_equal:tgl_selesai',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'user_id_scenario' => 'required|exists:users,id',
            'user_id_tester' => 'required|exists:users,id',
            'ref_tiket' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'perangkat' => 'nullable|string|max:255',
            'batasan' => 'nullable|string',
        ],[
            'judul.required' => 'Judul test suite harus diisi.',
            'user_id_pic.required' => 'PIC harus dipilih.',
            'user_id_pic.exists' => 'PIC yang dipilih tidak valid.',
            'tgl_mulai.required' => 'Tanggal mulai harus diisi.',
            'tgl_mulai.before_or_equal' => 'Tanggal mulai harus sebelum atau sama dengan tanggal selesai.',
            'tgl_selesai.required' => 'Tanggal selesai harus diisi.',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'user_id_scenario.required' => 'Scenario Writer harus dipilih.',
            'user_id_scenario.exists' => 'Scenario Writer yang dipilih tidak valid.',
            'user_id_tester.required' => 'Tester harus dipilih.',
            'user_id_tester.exists' => 'Tester yang dipilih tidak valid.',
            'url.url' => 'URL yang dimasukkan harus valid.',
        ]);

        $maxKode = TestSuite::where('project_id', $this->projectId)
            ->selectRaw('MAX(CAST(SUBSTRING(kode, 3) AS UNSIGNED)) as max_kode')
            ->pluck('max_kode')
            ->first();

        $newCode = $maxKode
            ? 'TS' . str_pad($maxKode + 1, 2, '0', STR_PAD_LEFT)
            : 'TS01';

        // Simpan data
        $testSuite = TestSuite::create([
            'kode' => $newCode,
            'project_id' => $this->projectId,
            'judul' => $this->judul,
            'user_id_pic' => $this->user_id_pic,
            'user_id_scenario' => $this->user_id_scenario,
            'user_id_tester' => $this->user_id_tester,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
            'ref_tiket' => $this->ref_tiket,
            'url' => $this->url,
            'perangkat' => $this->perangkat,
            'batasan' => $this->batasan,
            'progress' => 0,
        ]);

        $this->reset(['judul', 'user_id_pic', 'tgl_mulai', 'tgl_selesai', 'user_id_scenario', 'user_id_tester', 'ref_tiket', 'url', 'perangkat', 'batasan']);
        
        session()->flash('success', 'Test Suite berhasil ditambahkan!');

        return redirect()->route('testcase.index', [
            'projectId' => $this->projectId,  // Pastikan projectId sudah di-set
            'testSuiteId' => $testSuite->id,  // Menggunakan ID dari test suite yang baru dibuat
        ]);
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.create');
    }
}
