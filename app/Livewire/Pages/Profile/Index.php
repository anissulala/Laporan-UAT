<?php
namespace App\Livewire\Pages\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public $name;
    public $email;
    public $roles;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = implode(', ', $user->userRoles->pluck('role.nama')->toArray());
    }

    public function render()
    {
        // Ambil data terbaru dari database
    $this->name = auth()->user()->name;
    $this->email = auth()->user()->email;
        return view('livewire.pages.profile.index');
    }
}
