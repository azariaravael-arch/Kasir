<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'stock',
        'price',
        'image',
        'category'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (!$product->sku || $product->sku == '') {
                $lastProduct = static::where('sku', 'like', 'RR-%')
                    ->orderByRaw('CAST(SUBSTRING(sku, 4) AS UNSIGNED) DESC')
                    ->first();
                if ($lastProduct) {
                    $lastNumber = (int) substr($lastProduct->sku, 3);
                    $product->sku = 'RR-' . ($lastNumber + 1);
                } else {
                    $product->sku = 'RR-0';
                }
            }
        });
    }

    // Scope untuk filter produk aktif (stok > 0)
    public function scopeActive($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Scope untuk live search
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%{$keyword}%")
            ->orWhere('sku', 'like', "%{$keyword}%");
    }

    // Relasi ke SaleItems
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Check apakah stok tersedia
    public function hasStock($qty = 1): bool
    {
        return $this->stock >= $qty;
    }
}
