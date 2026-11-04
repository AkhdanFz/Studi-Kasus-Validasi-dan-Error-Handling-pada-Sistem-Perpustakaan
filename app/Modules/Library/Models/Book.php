<?php

namespace App\Modules\Library\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = ['judul', 'isbn', 'tahun_terbit', 'harga', 'stok', 'stok_awal', 'author_id'];
    protected $casts = ['harga' => 'decimal:2'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}