<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Laporan Bulanan</h2>

                <div class="flex gap-4 mb-6">
                    <form method="GET" class="flex gap-2">
                        <input type="month" name="month" value="{{ $month }}" class="px-4 py-2 border border-gray-300 rounded">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Tampilkan
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                        <div class="text-gray-600 text-sm">Total Transaksi</div>
                        <div class="text-3xl font-bold">{{ $count }}</div>
                    </div>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4">
                        <div class="text-gray-600 text-sm">Total Penjualan</div>
                        <div class="text-3xl font-bold">Rp {{ number_format($total, 0, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Grafik -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-bold mb-4">Grafik Penjualan Harian</h3>
                    <canvas id="chartSales"></canvas>
                </div>

                <h3 class="text-xl font-bold mb-4">Detail Transaksi</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="text-left px-4 py-2">No. Invoice</th>
                                <th class="text-left px-4 py-2">Tanggal & Jam</th>
                                <th class="text-left px-4 py-2">Kasir</th>
                                <th class="text-right px-4 py-2">Total</th>
                                <th class="text-center px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $sale)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-semibold">{{ $sale->invoice }}</td>
                                    <td class="px-4 py-3">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3">{{ $sale->user->name }}</td>
                                    <td class="text-right px-4 py-3 font-bold">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    <td class="text-center px-4 py-3">
                                        <a href="{{ route('pos.show', $sale) }}" class="text-blue-500 hover:text-blue-700 text-xs">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-gray-500">
                                        Belum ada transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartSales').getContext('2d');
        
        const chartData = {!! json_encode($chartData) !!};
        
        const labels = chartData.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
        });

        const data = chartData.map(item => item.total);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: data,
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
