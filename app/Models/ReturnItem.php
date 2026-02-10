<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $fillable = [
        'return_id',
        'product_id',
        'purchase_item_id',
        'quantity',
        'unit_price',
        'subtotal',
        'reason'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relasi ke ProductReturn
    public function productReturn()
    {
        return $this->belongsTo(ProductReturn::class, 'return_id');
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke PurchaseItem
    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class);
    }

    /**
     * Hitung subtotal
     */
    public function calculateSubtotal()
    {
        return $this->quantity * $this->unit_price;
    }
}
