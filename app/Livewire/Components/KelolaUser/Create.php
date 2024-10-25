<?php

namespace App\Livewire\Components\KelolaUser;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\UserRole;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;

#[Layout('components.layouts.app')]

class Create extends Component
{
    public $name;
    public $email;
    public $roles = [];
    public $createPassword;
    
    public function render()
    {
        return view('livewire.components.kelola-user.create', [
            'availableRoles' => Role::all(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'roles' => 'required|array',
        ],[
            'name.required' => 'Kolom Nama harus diisi.',
            'name.unique' => 'Pengguna dengan Nama ini sudah ada.',
            'name.string' => 'Kolom Nama harus berupa teks.',
            'name.max' => 'Kolom Nama maksimal 255 karakter.',
            'email.required' => 'Kolom Email harud diisi.',
            'email.unique' => 'Pengguna dengan Email ini sudah ada.',
            'email.email' => 'Kolom Email harus berupa email.',
            'email.string' => 'Kolom Email harus berupa teks.',
            'email.max' => 'Kolom Email maksimal 255 karakter.',
        ]);

        $password = Str::random(16);
        $this->createPassword = $password;

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($password),
        ]);

        foreach ($this->roles as $role_id) {
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $role_id,
            ]);
        }

        $this->dispatch('userStored');
        $this->dispatch('showCreatePassword', $this->createPassword, $this->name);

        session()->flash('success', 'Pengguna berhasil ditambahkan.');
        $this->reset(['name', 'email', 'roles']);
    }
}
