<?php

namespace App\Livewire\Pages\Projects\TestSuites;

use App\Models\TestSuite;
use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $projectId;
    public $search;

    public function mount($projectId)
    {
        $this->projectId = $projectId;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Ambil proyek berdasarkan ID
        $project = Project::findOrFail($this->projectId);
        
        // Query untuk mendapatkan test suite yang terkait dengan proyek tertentu
        $query = TestSuite::where('project_id', $this->projectId);

        // Jika ada kata kunci pencarian
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('kode', 'like', "%{$this->search}%")
                  ->orWhere('judul', 'like', "%{$this->search}%");
            });
        }
        // Hitung jumlah test suite
        $test_suite_count = $query->count();

        // Paginate hasil query
        $test_suite = $query->paginate(5);

        return view('livewire.pages.projects.test-suites.index', [
            'project' => $project,
            'test_suite' => $test_suite,
            'test_suite_count' => $test_suite_count,
        ]);
    }
}
