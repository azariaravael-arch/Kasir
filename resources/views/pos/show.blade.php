<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card shadow-premium">
                <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-50">
                    <h2 class="text-2xl font-black text-gray-900 flex items-center gap-3">
                        <i class="fas fa-receipt text-primary-500"></i> Detail Transaksi
                    </h2>
                    <a href="{{ route('pos.receipt', $sale) }}" class="primary-btn flex items-center gap-2">
                        <i class="fas fa-print"></i> Lihat Struk
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8 pb-8 border-b border-gray-50">
                    <div>
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">No. Invoice
                        </div>
                        <div class="text-lg font-black text-gray-900">{{ $sale->invoice }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal</div>
                        <div class="text-sm font-bold text-gray-600">{{ $sale->created_at->format('d M Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Kasir</div>
                        <div class="text-sm font-bold text-gray-600">{{ $sale->user->name }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Transaksi
                        </div>
                        <div class="text-xl font-black text-primary-600">Rp
                            {{ number_format($sale->total, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center gap-2">
                    <i class="fas fa-list-ul text-gray-400"></i> Item Penjualan
                </h3>

                <div class="overflow-x-auto border border-gray-50 rounded-xl overflow-hidden mb-8">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            <tr>
                                <th class="text-left px-6 py-4">Produk</th>
                                <th class="text-center px-6 py-4">Qty</th>
                                <th class="text-right px-6 py-4">Harga</th>
                                <th class="text-right px-6 py-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($sale->items as $item)
                                <tr class="group hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors">
                                            {{ $item->product->name ?? 'Produk Dihapus' }}</div>
                                        <div class="text-[10px] font-bold text-gray-400">SKU:
                                            {{ $item->product->sku ?? '-' }}</div>
                                    </td>
                                    <td class="text-center px-6 py-4">
                                        <span class="px-2.5 py-1 bg-gray-100 rounded-lg font-bold text-gray-600">
                                            {{ $item->qty }}
                                        </span>
                                    </td>
                                    <td class="text-right px-6 py-4 font-medium text-gray-500">Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-right px-6 py-4 font-black text-primary-600">Rp
                                        {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end pt-4">
                    <div class="w-full md:w-80">
                        <div
                            class="flex justify-between items-center p-4 bg-primary-50 rounded-2xl border border-primary-100">
                            <span class="font-black text-primary-700 uppercase tracking-widest text-xs">Total
                                Pembayaran</span>
                            <span class="font-black text-2xl text-primary-700">Rp
                                {{ number_format($sale->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>