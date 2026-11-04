<?php

namespace App\Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Library\Exceptions\BookNotAvailableException;
use App\Modules\Library\Exceptions\BookStockFullException;
use App\Modules\Library\Models\Author;
use App\Modules\Library\Models\Book;
use App\Modules\Library\Requests\StoreBookRequest;
use App\Modules\Library\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::orderBy('nama')->get();
        return view('books.create', compact('authors'));
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $data['stok_awal'] = $data['stok'];
        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $authors = Author::orderBy('nama')->get();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();
        $data['stok_awal'] = $data['stok'];
        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function borrow(Book $book)
    {
        if ($book->stok <= 0) {
            throw new BookNotAvailableException($book->judul);
        }

        $book->decrement('stok');

        return back()->with('success', "Buku '{$book->judul}' berhasil dipinjam.");
    }

    public function returnBook(Book $book)
    {
        if ($book->stok >= $book->stok_awal) {
            throw new BookStockFullException($book->judul);
        }

        $book->increment('stok');

        return back()->with('success', "Buku '{$book->judul}' berhasil dikembalikan! Stok bertambah.");
    }
}