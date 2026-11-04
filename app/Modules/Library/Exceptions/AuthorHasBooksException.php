<?php

namespace App\Modules\Library\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class AuthorHasBooksException extends Exception
{
    public function __construct(protected string $nama, protected int $jumlahBuku)
    {
        parent::__construct("Penulis '{$nama}' masih memiliki {$jumlahBuku} buku dan tidak dapat dihapus.");
    }

    public function report(): void
    {
        Log::error($this->getMessage(), ['penulis' => $this->nama, 'jumlah_buku' => $this->jumlahBuku]);
    }

    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $this->getMessage()], 422);
        }

        return back()->with('error', $this->getMessage());
    }
}