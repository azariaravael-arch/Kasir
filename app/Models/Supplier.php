<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'city',
        'contact_person',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi ke Purchase
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // Scope untuk supplier aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%{$keyword}%")
            ->orWhere('contact_person', 'like', "%{$keyword}%")
            ->orWhere('phone', 'like', "%{$keyword}%");
    }
}
