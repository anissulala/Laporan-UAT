<div>
    <h2>Daftar Buku dan Jumlahnya:</h2>
    <ul>
        @foreach ($books as $book)
            <li>{{ $book }}</li>
        @endforeach
    </ul>
    <p>Total Buku: {{ $bookCount }}</p>
</div>
