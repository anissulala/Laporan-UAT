<?php

namespace App\Livewire\Forms\Projects;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateForm extends Form
{
    #[Validate('required|string|max:255', message: 'Nama wajib diisi!!!')]
    public $nama = '';

    #[Validate('required|string', message: 'Deskripsi wajib diisi!!!')]
    public $deskripsi = '';
}
