<?php

namespace App\Livewire\Components\KelolaUser;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Delete extends Component
{
    public $userId;
    public $users; // Tambahkan properti ini

    protected $listeners = ['deleteUser'];

    public function mount()
    {
        $this->users = User::all(); // Ambil semua data pengguna
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {

            //to do : belum menambahkan pesan error pada saat users masih ditugaskan
            // Hapus semua test suites yang mengacu pada pengguna
            $user->testResults()->delete(); // Hapus test results
            $user->userRoles()->delete(); // Hapus role pengguna
            $user->delete(); // Hapus pengguna

            // Redirect ke route dengan pesan sukses
            return redirect()->route('kelola-user.index')->with('success', 'Pengguna berhasil dihapus.');
        }
    }

    public function render()
    {
        return view('livewire.components.kelola-user.delete', [
            'users' => $this->users, // Kirimkan data pengguna ke view
        ]);
    }
}
