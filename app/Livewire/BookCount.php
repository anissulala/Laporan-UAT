<?php

namespace App\Livewire;

class BookCount extends BookList
{
    public function countBooks()
    {
        return count($this->books);
    }

    public function render()
    {
        return view('livewire.book-count', [
            'books' => $this->books,
            'bookCount' => $this->countBooks()
        ]);
    }
}
