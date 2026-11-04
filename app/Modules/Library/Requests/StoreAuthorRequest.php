<?php

namespace App\Modules\Library\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:authors,email'],
            'bio'   => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'  => 'Nama penulis wajib diisi.',
            'nama.max'       => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan.',
            'bio.max'        => 'Bio maksimal 1000 karakter.',
        ];
    }
}