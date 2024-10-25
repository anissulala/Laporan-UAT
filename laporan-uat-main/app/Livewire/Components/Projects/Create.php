<?php

namespace App\Livewire\Components\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public $nama;
    public $deskripsi;

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);


         // Simpan data project
         $project = Project::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
        ]);

        //name agar hilang
        $this->nama = NULL;
        $this->deskripsi = NULL;

        Session()->flash('success', 'Project berhasil ditambahkan!');

        // Redirect ke halaman test suite
        return redirect()->route('testsuite.index', ['projectId' => $project->id]);
    }

    public function render()
    {
        return view('livewire.components.projects.create');
    }
}
