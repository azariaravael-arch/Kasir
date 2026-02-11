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
     * @param string $status Status penjualan ('completed' atau 'held')
     * @param float $taxPercent Persentase pajak (default 10)
     * @return Sale
     */
    public function createSale(array $items, User $user = null, $status = 'completed', $taxPercent = 10)
    {
        return DB::transaction(function () use ($items, $user, $status, $taxPercent) {
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
                'total' => $total,
                'tax_percent' => $taxPercent,
                'status' => $status
            ]);

            // Buat sale items dan update stok produk jika status completed
            foreach ($items as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['qty'] * $item['price']
                ]);

                // Kurangi stok produk hanya jika status completed
                if ($status === 'completed') {
                    // Ini akan trigger ProductObserver
                    $product = Product::find($item['product_id']);
                    $product->decrement('stock', $item['qty']);
                }
            }

            return $sale;
        });
    }
}
