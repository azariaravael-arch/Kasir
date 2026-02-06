<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card shadow-premium">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-4 border-b border-gray-50 gap-4">
                    <h2 class="text-2xl font-black text-gray-900 flex items-center gap-3">
                        <i class="fas fa-calendar-day text-primary-500"></i> Laporan Harian
                    </h2>

                    <form method="GET" class="flex gap-2 w-full md:w-auto">
                        <input type="date" name="date" value="{{ $date }}"
                            class="block w-full md:w-48 border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all text-sm">
                        <button type="submit" class="primary-btn px-4 py-2 text-sm">
                            Tampilkan
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="premium-card border-l-4 border-primary-500 bg-primary-50/30 shadow-none py-4">
                        <div class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Total
                            Transaksi</div>
                        <div class="text-3xl font-black text-gray-900">{{ $count }}</div>
                    </div>
                    <div class="premium-card border-l-4 border-emerald-500 bg-emerald-50/30 shadow-none py-4">
                        <div class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Total
                            Penjualan</div>
                        <div class="text-3xl font-black text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</div>
                    </div>
                </div>

                <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center gap-2">
                    <i class="fas fa-list text-gray-400"></i> Detail Transaksi
                </h3>

                <div class="overflow-x-auto border border-gray-50 rounded-xl overflow-hidden">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            <tr>
                                <th class="text-left px-6 py-4">No. Invoice</th>
                                <th class="text-left px-6 py-4">Waktu</th>
                                <th class="text-left px-6 py-4">Kasir</th>
                                <th class="text-right px-6 py-4">Total</th>
                                <th class="text-center px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($sales as $sale)
                                <tr class="group hover:bg-gray-50/50 transition-colors">
                                    <td
                                        class="px-6 py-4 font-bold text-gray-900 group-hover:text-primary-600 transition-colors">
                                        {{ $sale->invoice }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 font-medium">{{ $sale->created_at->format('H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 font-bold">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center text-[10px] text-primary-600">
                                                {{ substr($sale->user->name, 0, 1) }}
                                            </div>
                                            {{ $sale->user->name }}
                                        </div>
                                    </td>
                                    <td class="text-right px-6 py-4 font-black text-gray-900">Rp
                                        {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    <td class="text-center px-6 py-4">
                                        <a href="{{ route('pos.show', $sale) }}"
                                            class="inline-flex items-center gap-1.5 text-primary-600 hover:text-primary-700 font-black text-[10px] uppercase tracking-wider bg-primary-50 px-3 py-1.5 rounded-lg border border-primary-100 hover:bg-primary-100 transition-all">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-12 text-gray-400">
                                        <i class="fas fa-info-circle text-2xl mb-3 opacity-20 block"></i>
                                        <span class="text-xs font-bold uppercase tracking-widest">Belum ada transaksi pada
                                            tanggal ini</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>