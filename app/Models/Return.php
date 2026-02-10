<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Return extends Model
{
    protected $fillable = [
        'return_number',
        'purchase_id',
        'supplier_id',
        'user_id',
        'total_amount',
        'reason',
        'status',
        'return_date',
        'notes'
    ];

    protected $casts = [
        'return_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    // Relasi ke Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke ReturnItem (detail items yang di-return)
    public function items()
    {
        return $this->hasMany(ReturnItem::class);
    }

    /**
     * Generate nomor retur otomatis
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($return) {
            if (!$return->return_number) {
                $lastReturn = static::where('return_number', 'like', 'RT-%')
                    ->orderByRaw('CAST(SUBSTRING(return_number, 4) AS UNSIGNED) DESC')
                    ->first();
                
                if ($lastReturn) {
                    $lastNumber = (int) substr($lastReturn->return_number, 3);
                    $return->return_number = 'RT-' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
                } else {
                    $return->return_number = 'RT-000001';
                }
            }
        });
    }

    /**
     * Scope untuk filter status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter tanggal
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
     * Approve return dan kurangi stok
     */
    public function approve()
    {
        $this->update([
            'status' => 'approved',
            'return_date' => now()
        ]);

        // Kurangi stok produk
        foreach ($this->items as $item) {
            $item->product->decrement('stock', $item->quantity);
        }
    }

    /**
     * Reject return
     */
    public function reject()
    {
        $this->update(['status' => 'rejected']);
    }
}
