<?php

namespace App\Livewire\Components\Projects\TestSuites;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ProjectsEdit extends Component
{
    public $projectId;
    public $nama;
    public $deskripsi;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    public function mount($projectId)
    {
        $project = Project::findOrFail($projectId);


        $this->projectId = $project->id;
        // Set nilai nama dan deskripsi dari data project yang ada
        $this->nama = $project->nama;
        $this->deskripsi = $project->deskripsi;
    }

    public function updateProject()
    {
        $this->validate();

        $project = Project::findOrFail($this->projectId);

        // Update project dengan nilai baru
        $project->update([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
        ]);

        Session()->flash('success', 'Project berhasil diperbarui!');
        
        return redirect()->route('testsuite.index', ['projectId' => $project->id]);

    }

    public function render()
    {
        return view('livewire.components.projects.test-suites.projects-edit');
    }
}
