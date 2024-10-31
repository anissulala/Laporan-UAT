<?php

namespace App\Livewire;

use Livewire\Component;

class BookList extends Component
{
    public $books = [];

    public function mount()
    {
        // Inisialisasi daftar buku
        $this->books = [
            'Buku A',
            'Buku B',
            'Buku C',
        ];
    }

    public function render()
    {
        return view('livewire.book-list', [
            'books' => $this->books
        ]);
    }
}
