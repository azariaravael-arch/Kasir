<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaleService
{
    /**
     * Buat transaksi penjualan dengan database transaction
     * 
     * @param array $items Item yang dijual
     * @param User $user User yang melakukan transaksi
     * @return Sale
     */
    public function createSale(array $items, User $user = null)
    {
        return DB::transaction(function () use ($items, $user) {
            $user = $user ?? auth()->user();
            $invoice = 'INV-'.date('Ymd').'-'.Str::random(5);
            $total = 0;

            // Hitung total
            foreach ($items as $item) {
                $total += $item['qty'] * $item['price'];
            }

            // Buat record sale
            $sale = Sale::create([
                'invoice' => $invoice,
                'user_id' => $user->id,
                'total' => $total
            ]);

            // Buat sale items dan update stok produk
            foreach ($items as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['qty'] * $item['price']
                ]);

                // Kurangi stok produk
                // Ini akan trigger ProductObserver
                $product = Product::find($item['product_id']);
                $product->decrement('stock', $item['qty']);
            }

            return $sale;
        });
    }
}
