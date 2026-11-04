<?php

namespace App\Modules\Library\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('isbn')) {
            $this->merge(['isbn' => str_replace(['-', ' '], '', $this->isbn)]);
        }
    }

    public function rules(): array
    {
        return [
            'judul'        => ['required', 'string', 'max:255'],
            'isbn'         => ['required', 'regex:/^(\d{9}[\dXx]|\d{13})$/', 'unique:books,isbn'],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'harga'        => ['required', 'numeric', 'min:0'],
            'stok'         => ['required', 'integer', 'min:0'],
            'author_id'    => ['required', 'exists:authors,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'        => 'Judul buku wajib diisi.',
            'judul.max'             => 'Judul maksimal 255 karakter.',
            'isbn.required'         => 'ISBN wajib diisi.',
            'isbn.regex'            => 'Format ISBN tidak valid (10 atau 13 digit).',
            'isbn.unique'           => 'ISBN sudah terdaftar.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer'  => 'Tahun terbit harus berupa angka bulat.',
            'tahun_terbit.min'      => 'Tahun terbit minimal 1900.',
            'tahun_terbit.max'      => 'Tahun terbit maksimal ' . date('Y') . '.',
            'harga.required'        => 'Harga wajib diisi.',
            'harga.numeric'         => 'Harga harus berupa angka.',
            'harga.min'             => 'Harga tidak boleh negatif.',
            'stok.required'         => 'Stok wajib diisi.',
            'stok.integer'          => 'Stok harus berupa bilangan bulat.',
            'stok.min'              => 'Stok tidak boleh kurang dari 0.',
            'author_id.required'    => 'Penulis wajib dipilih.',
            'author_id.exists'      => 'Penulis tidak ditemukan.',
        ];
    }
}