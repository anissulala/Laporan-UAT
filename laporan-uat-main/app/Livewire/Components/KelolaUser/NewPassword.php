<?php

namespace App\Livewire\Components\KelolaUser;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class NewPassword extends Component
{
    public $newPassword;
    public $userName;

    protected $listeners = ['showNewPassword'];

    public function showNewPassword($password, $name)
    {
        $this->newPassword = $password;
        $this->userName = $name;
        $this->dispatch('openNewPasswordModal'); // Mengirim event untuk membuka modal baru
    }
    
    public function render()
    {
        return view('livewire.components.kelola-user.new-password');
    }
}
