<?php

namespace App\Livewire\Components\Projects\TestSuites\TestCases;

use Livewire\Component;
use App\Models\TestCase;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public $judul;
    public $prakondisi = [];
    public $tahap_testing = [];
    public $data_input;
    public $test_suite_id;
    public $projectId;

    public function mount($projectId,$testSuiteId)
    {
        $this->projectId = $projectId;
        $this->test_suite_id = $testSuiteId;
        $this->prakondisi[] = ''; // Menambahkan field prakondisi awal
        $this->tahap_testing[] = ''; // Menambahkan field tahap testing awal
    }

    public function addPrakondisi()
    {
        $this->prakondisi[] = ''; // Menambah input prakondisi baru
    }

    public function addTahapTesting()
    {
        $this->tahap_testing[] = ''; // Menambah input tahap testing baru
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

    public function store()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'prakondisi' => 'required|array|min:1',
            'prakondisi.*' => 'required|string|max:255',
            'tahap_testing' => 'required|array|min:1',
            'tahap_testing.*' => 'required|string|max:255',
            'data_input' => 'required|string',
            'test_suite_id' => 'required|integer|exists:test_suite,id',
        ]);

        // Ambil nilai maksimum dari kolom kode yang ada, menggunakan perintah query langsung
        $maxKode = TestCase::where('test_suite_id', $this->test_suite_id)
            ->selectRaw('MAX(CAST(SUBSTRING(kode, 3) AS UNSIGNED)) as max_kode')
            ->pluck('max_kode')
            ->first();

        // Generate kode baru
        $newCode = $maxKode
            ? 'TC' . str_pad($maxKode + 1, 2, '0', STR_PAD_LEFT)
            : 'TC01';

        // Simpan data
        $testCase = TestCase::create([
            'kode' => $newCode,
            'test_suite_id' => $this->test_suite_id,
            'judul' => $this->judul,
            'prakondisi' => json_encode($this->prakondisi),
            'tahap_testing' => json_encode($this->tahap_testing),
            'data_input' => $this->data_input,
            'progress' => 0,
        ]);

        // Redirect ke halaman test results
        return redirect()->route('testresult.index', [
            'projectId' => $this->projectId,
            'testSuiteId' => $this->test_suite_id,
            'testCaseId' => $testCase->id, // Ambil ID test case yang baru dibuat
        ])->with('success', 'Test case berhasil ditambahkan!');
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.test-cases.create');
    }
}
