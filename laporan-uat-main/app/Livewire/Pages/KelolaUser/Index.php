<?php

namespace App\Livewire\Pages\KelolaUser;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    protected $listeners = ['userStored','resetPassword' => 'render'];
    public function render()
    {
        $users = User::with('userRoles.role')->paginate(10);

        return view('livewire.pages.kelola-user.index', [
            'users' => $users,
        ]);
    }
}
