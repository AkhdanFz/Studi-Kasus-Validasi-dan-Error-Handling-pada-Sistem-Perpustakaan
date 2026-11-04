<?php

namespace App\Modules\Products\Models;

use App\Modules\Products\Exceptions\InsufficientStockException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'stock',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function decreaseStock(int $qty): void
    {
        if ($qty > $this->stock) {
            throw new InsufficientStockException($this->name, $this->stock, $qty);
        }

        $this->decrement('stock', $qty);
    }
}