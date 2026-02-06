<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-3">
                <i class="fas fa-chart-line text-primary-500"></i>
                Dashboard
            </h1>

            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="premium-card border-l-4 border-primary-500 shadow-premium">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">Penjualan Hari Ini</div>
                    <div class="mt-3 flex items-baseline justify-between">
                        <div class="text-3xl font-black text-gray-900">Rp {{ number_format($todayTotal, 0, ',', '.') }}
                        </div>
                        <div
                            class="text-xs font-bold text-primary-700 bg-primary-50 px-3 py-1.5 rounded-full border border-primary-100">
                            <i class="fas fa-shopping-basket mr-1"></i> {{ $todayCount }} Transaksi
                        </div>
                    </div>
                </div>

                <div class="premium-card border-l-4 border-gray-800 shadow-premium">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">Penjualan Bulan Ini</div>
                    <div class="mt-3 flex items-baseline justify-between">
                        <div class="text-3xl font-black text-gray-900">Rp {{ number_format($monthTotal, 0, ',', '.') }}
                        </div>
                        <div
                            class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full border border-gray-200">
                            <i class="fas fa-calendar-alt mr-1"></i> {{ $monthCount }} Transaksi
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Top Products -->
                <div class="lg:col-span-2">
                    <div class="premium-card shadow-premium">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-50">
                            <h3 class="text-lg font-black text-gray-900 flex items-center gap-2">
                                <i class="fas fa-fire text-orange-500"></i> Top Produk Terlaris
                            </h3>
                            <span class="text-[10px] font-bold text-gray-400 uppercase">Top 5</span>
                        </div>

                        @if($topProducts->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-gray-950">
                                    <thead>
                                        <tr
                                            class="text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                            <th class="pb-4">Produk</th>
                                            <th class="pb-4 text-center">Terjual</th>
                                            <th class="pb-4 text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach($topProducts as $product)
                                            <tr class="group hover:bg-gray-50/50 transition-colors">
                                                <td
                                                    class="py-4 text-sm font-bold text-gray-900 group-hover:text-primary-600 transition-colors">
                                                    {{ $product->name }}</td>
                                                <td class="py-4 text-center">
                                                    <span
                                                        class="text-xs font-bold px-2.5 py-1 bg-gray-100 rounded-lg text-gray-600">
                                                        {{ $product->total_qty }} Unit
                                                    </span>
                                                </td>
                                                <td class="py-4 text-right text-sm font-black text-primary-600">Rp
                                                    {{ number_format($product->total_amount, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-12 text-gray-400 italic text-sm">Belum ada data penjualan.</div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="space-y-4">
                    <div class="premium-card shadow-premium">
                        <h3
                            class="text-lg font-black text-gray-900 mb-6 pb-4 border-b border-gray-50 flex items-center gap-2">
                            <i class="fas fa-bolt text-yellow-500"></i> Akses Cepat
                        </h3>

                        <div class="grid grid-cols-1 gap-4">
                            <a href="{{ route('pos.index') }}"
                                class="flex items-center p-4 bg-primary-50 text-primary-700 rounded-xl hover:bg-primary-100 transition border border-primary-100 group shadow-sm">
                                <span
                                    class="w-12 h-12 flex items-center justify-center bg-white rounded-lg text-2xl mr-4 shadow-sm group-hover:scale-110 transition-transform">🛒</span>
                                <div>
                                    <div class="font-black text-sm">Buka Kasir</div>
                                    <div class="text-[10px] uppercase font-bold opacity-60">Mulai transaksi baru</div>
                                </div>
                                <i
                                    class="fas fa-arrow-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </a>

                            <a href="{{ route('products.index') }}"
                                class="flex items-center p-4 bg-white text-gray-700 rounded-xl hover:bg-gray-50 transition border border-gray-100 group shadow-sm">
                                <span
                                    class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-lg text-2xl mr-4 group-hover:scale-110 transition-transform">📦</span>
                                <div>
                                    <div class="font-black text-sm">Kelola Produk</div>
                                    <div class="text-[10px] uppercase font-bold opacity-60">Stok dan Harga</div>
                                </div>
                                <i
                                    class="fas fa-arrow-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </a>

                            <a href="{{ route('reports.monthly') }}"
                                class="flex items-center p-4 bg-white text-gray-700 rounded-xl hover:bg-gray-50 transition border border-gray-100 group shadow-sm">
                                <span
                                    class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-lg text-2xl mr-4 group-hover:scale-110 transition-transform">📊</span>
                                <div>
                                    <div class="font-black text-sm">Laporan Bulanan</div>
                                    <div class="text-[10px] uppercase font-bold opacity-60">Lihat performa toko</div>
                                </div>
                                <i
                                    class="fas fa-arrow-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>