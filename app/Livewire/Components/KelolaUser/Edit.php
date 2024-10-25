<?php

namespace App\Livewire\Components\KelolaUser;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\UserRole;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]

class Edit extends Component
{
    public $userId;
    public $name;
    public $email;
    public $roles = [];
    public $availableRoles = [];
    public $user;

    public function mount($userId)
    {
        $this->userId = $userId;

        $this->user = User::findOrFail($userId);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->roles = $this->user->userRoles->pluck('role_id')->toArray();

        $this->availableRoles = Role::all()->toArray();
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->userId,
            'roles' => 'required|array',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        UserRole::where('user_id', $user->id)->delete();
        foreach ($this->roles as $role_id) {
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $role_id,
            ]);
        }

        session()->flash('success', 'Pengguna berhasil diperbarui.');
        return redirect()->route('kelola-user.index');
    }

    public function render()
    {
        return view('livewire.components.kelola-user.edit');
    }
}
