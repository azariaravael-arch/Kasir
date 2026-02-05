<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-[calc(100vh-64px)]">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-8 border border-gray-200">

                <!-- Receipt Header -->
                <div class="text-center border-b pb-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 uppercase">Struk Pembayaran</h2>
                    <p class="text-sm text-gray-500 mt-1 font-bold">{{ config('app.name', 'Laravel POS') }}</p>
                </div>

                <!-- Transaction Info -->
                <div class="grid grid-cols-2 gap-4 mb-8 text-sm">
                    <div>
                        <div class="text-gray-500 font-bold text-xs uppercase">No. Invoice</div>
                        <div class="font-bold text-gray-950">{{ $sale->invoice }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-gray-500 font-bold text-xs uppercase">Tanggal</div>
                        <div class="font-bold text-gray-950">{{ $sale->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-gray-500 font-bold text-xs uppercase">Kasir</div>
                        <div class="font-bold text-gray-950">{{ $sale->user->name }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-gray-500 font-bold text-xs uppercase">Status</div>
                        <div class="font-bold text-blue-700">LUNAS</div>
                    </div>
                </div>

                <!-- Items -->
                <div class="space-y-4 mb-8">
                    <div class="text-xs font-bold text-gray-400 uppercase tracking-widest border-b pb-2">Rincian Item
                    </div>
                    @foreach($sale->items as $item)
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="text-sm font-bold text-gray-900">{{ $item->product->name }}</div>
                                <div class="text-xs text-gray-500 font-bold">{{ $item->qty }} x Rp
                                    {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="text-right text-sm font-bold text-gray-900">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Footer Summary -->
                <div class="border-t-2 border-dashed pt-6 space-y-2">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 font-bold uppercase">Subtotal</span>
                        <span class="font-bold text-gray-900">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-gray-950 p-4 rounded-lg mt-4">
                        <span class="text-white text-xs font-bold uppercase">Total Bayar</span>
                        <span class="text-white text-xl font-extrabold text-blue-400">Rp
                            {{ number_format($sale->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="text-center mt-10 text-gray-400 text-xs font-bold uppercase">
                    Terima Kasih Atas Kunjungan Anda
                </div>

                <!-- Actions -->
                <div class="mt-10 flex flex-col gap-3 no-print">
                    <button onclick="window.print()"
                        class="w-full py-3 bg-gray-800 text-white rounded-md font-bold text-sm hover:bg-black transition">
                        CETAK STRUK
                    </button>
                    <a href="{{ route('pos.index') }}"
                        class="w-full py-3 bg-blue-600 text-white rounded-md font-bold text-sm text-center hover:bg-blue-700 transition">
                        KEMBALI KE KASIR
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body,
            .bg-gray-100 {
                background: white !important;
            }

            .py-12 {
                padding: 0 !important;
            }

            .shadow-sm {
                box-shadow: none !important;
                border: none !important;
            }

            .bg-white {
                border: none !important;
                padding: 0 !important;
            }

            .border-gray-200 {
                border-color: #000 !important;
            }

            .rounded-lg {
                border-radius: 0 !important;
            }

            .bg-gray-950 {
                background: transparent !important;
                color: #000 !important;
                border-top: 1px solid #000 !important;
                border-bottom: 1px solid #000 !important;
                padding: 10px 0 !important;
            }

            .text-blue-400 {
                color: #000 !important;
            }

            img {
                display: none !important;
            }

            * {
                box-shadow: none !important;
                text-shadow: none !important;
            }
        }
    </style>
</x-app-layout>