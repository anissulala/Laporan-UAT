<?php
namespace App\Livewire\Components\Projects\TestSuites\TestCases;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\TestSuite;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class TestSuitesEdit extends Component
{
    public $testSuiteId;
    public $test_suite;
    public $users;
    public $judul;
    public $user_id_pic;
    public $tgl_mulai;
    public $user_id_scenario;
    public $tgl_selesai;
    public $user_id_tester;
    public $ref_tiket;
    public $url;
    public $perangkat;
    public $batasan;
    public $projectId;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'user_id_pic' => 'required|integer',
        'tgl_mulai' => 'required|date',
        'user_id_scenario' => 'required|integer',
        'tgl_selesai' => 'required|date',
        'user_id_tester' => 'required|integer',
        'ref_tiket' => 'nullable|string|max:255',
        'url' => 'nullable|string|max:255',
        'perangkat' => 'nullable|string|max:255',
        'batasan' => 'nullable|string',
    ];

    public function mount($test_suite_id,$project_id)
    {
        $this->testSuiteId = $test_suite_id;
        $this->projectId = $project_id;
        $this->test_suite = TestSuite::findOrFail($test_suite_id);
        $this->users = User::all();
        $this->judul = $this->test_suite->judul;
        $this->user_id_pic = $this->test_suite->user_id_pic;
        $this->tgl_mulai = $this->test_suite->tgl_mulai ? Carbon::parse($this->test_suite->tgl_mulai)->format('Y-m-d') : '';
        $this->user_id_scenario = $this->test_suite->user_id_scenario;
        $this->tgl_selesai = $this->test_suite->tgl_selesai ? Carbon::parse($this->test_suite->tgl_selesai)->format('Y-m-d') : '';
        $this->user_id_tester = $this->test_suite->user_id_tester;
        $this->ref_tiket = $this->test_suite->ref_tiket;
        $this->url = $this->test_suite->url;
        $this->perangkat = $this->test_suite->perangkat;
        $this->batasan = $this->test_suite->batasan;
    }

    public function update()
    {
        $this->validate();

        $this->test_suite->update([
            'judul' => $this->judul,
            'user_id_pic' => $this->user_id_pic,
            'tgl_mulai' => $this->tgl_mulai,
            'user_id_scenario' => $this->user_id_scenario,
            'tgl_selesai' => $this->tgl_selesai,
            'user_id_tester' => $this->user_id_tester,
            'ref_tiket' => $this->ref_tiket,
            'url' => $this->url,
            'perangkat' => $this->perangkat,
            'batasan' => $this->batasan,
        ]);

        session()->flash('success', 'Test Suite Berhasil Di Update');
        return redirect()->route('testcase.index', [
            'projectId' => $this->projectId,  // Pastikan projectId sudah di-set
            'testSuiteId' => $this->test_suite->id,  // Menggunakan ID dari test suite yang baru dibuat
        ]);
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.test-suites-edit');
    }
}