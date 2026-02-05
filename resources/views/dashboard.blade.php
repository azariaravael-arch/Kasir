<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Penjualan Hari Ini</div>
                    <div class="mt-2 flex items-baseline justify-between">
                        <div class="text-3xl font-bold text-gray-900">Rp {{ number_format($todayTotal, 0, ',', '.') }}
                        </div>
                        <div class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">{{ $todayCount }}
                            Transaksi</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-gray-800">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Penjualan Bulan Ini</div>
                    <div class="mt-2 flex items-baseline justify-between">
                        <div class="text-3xl font-bold text-gray-900">Rp {{ number_format($monthTotal, 0, ',', '.') }}
                        </div>
                        <div class="text-xs font-bold text-gray-600 bg-gray-50 px-2 py-1 rounded">{{ $monthCount }}
                            Transaksi</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Top Products -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 pb-2 border-b">Top 5 Produk Terlaris</h3>

                        @if($topProducts->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 text-gray-900">
                                    <thead>
                                        <tr>
                                            <th class="text-left text-xs font-bold text-gray-500 uppercase py-3">Produk</th>
                                            <th class="text-center text-xs font-bold text-gray-500 uppercase py-3">Terjual
                                            </th>
                                            <th class="text-right text-xs font-bold text-gray-500 uppercase py-3">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($topProducts as $product)
                                            <tr>
                                                <td class="py-4 text-sm font-bold text-gray-900">{{ $product->name }}</td>
                                                <td class="py-4 text-center text-sm text-gray-600">{{ $product->total_qty }}
                                                    Unit</td>
                                                <td class="py-4 text-right text-sm font-bold text-blue-700">Rp
                                                    {{ number_format($product->total_amount, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-12 text-gray-400 italic">Belum ada data penjualan.</div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="space-y-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 pb-2 border-b">Akses Cepat</h3>

                        <div class="grid grid-cols-1 gap-3">
                            <a href="{{ route('pos.index') }}"
                                class="flex items-center p-4 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition border border-blue-100">
                                <span class="text-2xl mr-3">🛒</span>
                                <div>
                                    <div class="font-bold">Buka Kasir</div>
                                    <div class="text-xs opacity-60">Mulai transaksi baru</div>
                                </div>
                            </a>

                            <a href="{{ route('products.index') }}"
                                class="flex items-center p-4 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition border border-gray-200">
                                <span class="text-2xl mr-3">📦</span>
                                <div>
                                    <div class="font-bold">Kelola Produk</div>
                                    <div class="text-xs opacity-60">Stok dan Harga</div>
                                </div>
                            </a>

                            <a href="{{ route('reports.monthly') }}"
                                class="flex items-center p-4 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition border border-gray-200">
                                <span class="text-2xl mr-3">📊</span>
                                <div>
                                    <div class="font-bold text-gray-900 tracking-tight">Laporan Bulanan</div>
                                    <div class="text-xs opacity-60">Lihat performa toko</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>