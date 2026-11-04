<?php

namespace App\Modules\Library\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class BookStockFullException extends Exception
{
    public function __construct(protected string $judul)
    {
        parent::__construct("Buku '{$judul}' tidak dapat dikembalikan: tidak ada buku yang sedang dipinjam.");
    }

    public function report(): void
    {
        Log::error($this->getMessage(), ['judul' => $this->judul]);
    }

    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $this->getMessage()], 422);
        }

        return back()->with('error', $this->getMessage());
    }
}