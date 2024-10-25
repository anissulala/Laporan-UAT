<?php

namespace App\Livewire\Pages\Login;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class index extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ];

    public function login()
    {
        $this->validate();

        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials)) {
            session()->flash('success', 'Login berhasil.');
            return redirect()->intended('/');
        }

        session()->flash('error', 'Email atau kata sandi salah.');
    }

    public function render()
    {
        return view('livewire.pages.login.index');
    }
}