<?php

namespace App\Modules\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:5000'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['exists:categories,id']
        ];
    }

    public function messages(): array
    {
        return [
        'name.required'          => 'Nama produk wajib diisi.',
        'name.string'            => 'Nama produk harus berupa teks.',
        'name.max'               => 'Nama produk maksimal 255 karakter.',

        'slug.required'          => 'Slug wajib diisi.',
        'slug.string'            => 'Slug harus berupa teks.',
        'slug.max'               => 'Slug maksimal 255 karakter.',
        'slug.unique'            => 'Slug produk sudah digunakan.',

        'price.required'         => 'Harga produk wajib diisi.',
        'price.numeric'          => 'Harga harus berupa angka.',
        'price.min'              => 'Harga tidak boleh kurang dari 0.',

        'stock.required'         => 'Stok wajib diisi.',
        'stock.integer'          => 'Stok harus berupa angka bulat.',
        'stock.min'              => 'Stok tidak boleh kurang dari 0.',

        'description.string'     => 'Deskripsi harus berupa teks.',
        'description.max'        => 'Deskripsi maksimal 5000 karakter.',

        'category_ids.array'     => 'Format kategori tidak valid.',
        'category_ids.*.exists'  => 'Kategori yang dipilih tidak ditemukan.',
    ];

    }
}
