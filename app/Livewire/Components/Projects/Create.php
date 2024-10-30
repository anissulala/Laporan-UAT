<?php

namespace App\Livewire\Components\Projects;

use App\Livewire\Forms\Projects\CreateForm;
use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public CreateForm $form;

    /**
     * Method untuk menyimpan project baru setelah validasi.
     */
    public function store()
    {
        // Lakukan validasi menggunakan aturan dari form object
        $this->form->validate();

        // Simpan data project ke database
        $project = Project::create([
            'nama' => $this->form->nama,
            'deskripsi' => $this->form->deskripsi,
        ]);

        // Reset input setelah berhasil menyimpan
        $this->form->reset(['nama', 'deskripsi']);

        session()->flash('success', 'Project berhasil ditambahkan!');

        // Redirect ke halaman test suite
        return redirect()->route('testsuite.index', ['projectId' => $project->id]);
    }

    /**
     * Render view untuk form pembuatan project.
     */
    public function render()
    {
        return view('livewire.components.projects.create');
    }
}
