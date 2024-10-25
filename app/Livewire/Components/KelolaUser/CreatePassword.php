<?php

namespace App\Livewire\Components\KelolaUser;

use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('components.layouts.app')]

class CreatePassword extends Component
{
    public $createPassword;
    public $userName;

    protected $listeners = ['showCreatePassword'];

    public function showCreatePassword($password, $name)
    {
        $this->createPassword = $password;
        $this->userName = $name;
        $this->dispatch('openCreatePasswordModal');
    }

    public function render()
    {
        return view('livewire.components.kelola-user.create-password');
    }
}
