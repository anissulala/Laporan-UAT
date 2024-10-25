<?php

namespace App\Livewire\Components\KelolaUser;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;

#[Layout('components.layouts.app')]

class ResetPassword extends Component
{
    public $userId;
    public $user;
    public $newPassword;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
    }

    public function resetPassword()
    {
        // Generate password baru secara otomatis
        $this->newPassword = Str::random(16);

        // Update password pengguna
        $user = User::findOrFail($this->userId);
        $user->update([
            'password' => Hash::make($this->newPassword),
        ]);

        $this->dispatch('resetPassword', $this->userId);
        $this->dispatch('showNewPassword', $this->newPassword, $this->user->name);

        session()->flash('success', 'Reset Password berhasil!!!');
    }


    public function render()
    {
        return view('livewire.components.kelola-user.reset-password');
    }
}