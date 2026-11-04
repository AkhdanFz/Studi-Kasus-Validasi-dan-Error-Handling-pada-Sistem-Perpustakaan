<?php

namespace App\Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Library\Exceptions\AuthorHasBooksException;
use App\Modules\Library\Models\Author;
use App\Modules\Library\Requests\StoreAuthorRequest;
use App\Modules\Library\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->paginate(10);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        Author::create($request->validated());

        return redirect()->route('authors.index')->with('success', 'Penulis berhasil ditambahkan.');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return redirect()->route('authors.index')->with('success', 'Penulis berhasil diperbarui.');
    }

    public function destroy(Author $author)
    {
        $jumlah = $author->books()->count();

        if ($jumlah > 0) {
            throw new AuthorHasBooksException($author->nama, $jumlah);
        }

        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Penulis berhasil dihapus.');
    }
}