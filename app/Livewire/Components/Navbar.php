<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index')->with('success', 'Anda telah logout.');
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}
