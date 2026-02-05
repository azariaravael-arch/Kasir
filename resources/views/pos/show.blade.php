<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Detail Transaksi</h2>
                    <a href="{{ route('pos.receipt', $sale) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Lihat Struk
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6 pb-6 border-b">
                    <div>
                        <div class="text-sm text-gray-600">No. Invoice</div>
                        <div class="text-2xl font-bold">{{ $sale->invoice }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Tanggal</div>
                        <div class="text-lg font-semibold">{{ $sale->created_at->format('d M Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Kasir</div>
                        <div class="text-lg font-semibold">{{ $sale->user->name }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Total Transaksi</div>
                        <div class="text-2xl font-bold text-green-600">Rp {{ number_format($sale->total, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <h3 class="text-xl font-bold mb-4">Item Penjualan</h3>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-4 py-2">Produk</th>
                            <th class="text-center px-4 py-2">Qty</th>
                            <th class="text-right px-4 py-2">Harga</th>
                            <th class="text-right px-4 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="font-semibold">{{ $item->product->name ?? 'Produk Dihapus' }}</div>
                                    <div class="text-xs text-gray-600">SKU: {{ $item->product->sku ?? '-' }}</div>
                                </td>
                                <td class="text-center px-4 py-3">{{ $item->qty }}</td>
                                <td class="text-right px-4 py-3">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-right px-4 py-3 font-semibold">Rp
                                    {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-end mt-6">
                    <div class="w-80">
                        <div class="border-t pt-4">
                            <div class="flex justify-between mb-4">
                                <span class="font-semibold text-lg">Total:</span>
                                <span class="font-bold text-2xl">Rp
                                    {{ number_format($sale->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>