<?php

use App\Modules\Library\Controllers\AuthorController;
use App\Modules\Library\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
    Route::post('books/{book}/return', [BookController::class, 'returnBook'])->name('books.return');
    Route::resource('books', BookController::class)->except('show');
    Route::resource('authors', AuthorController::class)->except('show');
});