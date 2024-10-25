<?php

namespace App\Livewire\Components\Projects\TestSuites;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ProjectsDelete extends Component
{
    public $projectId;
    public $projectnama;

    public function mount($projectId)
    {
        // Ambil data project berdasarkan ID
        $project = Project::findOrFail($projectId);
        $this->projectId = $projectId;
        $this->projectnama = $project->nama; // Simpan nama project
    }

    public function deleteProject()
    {
        $project = Project::findOrFail($this->projectId);

        // Periksa apakah project memiliki test suite
        if ($project->testSuites()->count() > 0) {
            session()->flash('error', 'Tidak dapat menghapus project karena masih ada test suite!');
            return redirect()->route('testsuite.index', ['projectId' => $this->projectId]);
        }

        $project->delete();

        session()->flash('success', 'Project berhasil dihapus!');
        // Redirect ke halaman index project dengan pesan sukses
        return redirect()->route('project.index');
    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.projects-delete');
    }
}
