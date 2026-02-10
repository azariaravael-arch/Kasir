<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_number',
        'supplier_id',
        'user_id',
        'total_amount',
        'status',
        'notes',
        'received_date'
    ];

    protected $casts = [
        'received_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi ke User (yang membuat pembelian)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke PurchaseItem (detail items pembelian)
    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * Generate nomor pembelian otomatis
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($purchase) {
            if (!$purchase->purchase_number) {
                $lastPurchase = static::where('purchase_number', 'like', 'PB-%')
                    ->orderByRaw('CAST(SUBSTRING(purchase_number, 4) AS UNSIGNED) DESC')
                    ->first();
                
                if ($lastPurchase) {
                    $lastNumber = (int) substr($lastPurchase->purchase_number, 3);
                    $purchase->purchase_number = 'PB-' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
                } else {
                    $purchase->purchase_number = 'PB-000001';
                }
            }
        });
    }

    /**
     * Scope untuk filter pembelian berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter pembelian dalam periode tertentu
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Hitung total amount dari items
     */
    public function calculateTotal()
    {
        return $this->items()->sum(\DB::raw('quantity * unit_price'));
    }

    /**
     * Update status ke "Received"
     */
    public function markAsReceived()
    {
        $this->update([
            'status' => 'received',
            'received_date' => now()
        ]);

        // Update stok produk
        foreach ($this->items as $item) {
            $item->product->increment('stock', $item->quantity);
        }
    }
}
