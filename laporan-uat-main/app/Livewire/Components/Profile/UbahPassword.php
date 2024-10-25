<?php

namespace App\Livewire\Components\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Layout('components.layouts.app')]
class UbahPassword extends Component
{
    public $old_password;
    public $new_password;
    public $new_password_confirmation;

    public function updatePassword()
    {
        $user = Auth::user();

        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'old_password.required' => 'Masukkan password lama',
            'new_password.required' => 'Masukkan password baru'
        ]);

        if (!Hash::check($this->old_password, $user->password)) {
            return $this->addError('old_password', 'Password lama tidak cocok');
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['old_password', 'new_password', 'new_password_confirmation']);
        
        session()->flash('success', 'Password berhasil diubah');
        return redirect()->route('profile.index');
    }

    public function render()
    {
        return view('livewire.components.profile.ubah-password');
    }
}