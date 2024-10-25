<?php
namespace App\Livewire\Components\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class Edit extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        // Ambil data pengguna saat ini
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $user = Auth::user();
        
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);

        session()->flash('success', 'Profil berhasil diperbarui');
        return redirect()->route('profile.index');
    }

    public function render()
    {

        return view('livewire.components.profile.edit');
    }
}
