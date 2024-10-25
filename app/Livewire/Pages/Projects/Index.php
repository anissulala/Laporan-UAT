<?php

namespace App\Livewire\Pages\Projects;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Url]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Query dasar untuk mengambil semua project beserta jumlah test suite yang belum dan sudah selesai
        $query = Project::withCount([
            'testSuites as belum_selesai_count' => function ($query) {
                $query->where('progress', '<', 100);
            },
            'testSuites as sudah_selesai_count' => function ($query) {
                $query->where('progress', '=', 100);
            },
        ]);

        // Jika ada kata kunci pencarian
        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        }

        // Menghitung total jumlah project
        $totalProjects = $query->count();

        // Melakukan paginate untuk project
        $projects = $query->paginate(5);

        // Mengirim data ke view
        return view('livewire.pages.projects.index', [
            'projects' => $projects,
            'totalProjects' => $totalProjects,
        ]);
    }
}

