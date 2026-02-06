<x-app-layout>
    <div class="py-10 bg-gray-50/50 min-h-[calc(100vh-64px)]">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card shadow-premium p-8 border-none ring-1 ring-gray-100">

                <!-- Receipt Header -->
                <div class="text-center border-b border-gray-100 pb-6 mb-8">
                    <div
                        class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-primary-100">
                        <i class="fas fa-receipt text-2xl text-primary-600"></i>
                    </div>
                    <h2 class="text-xl font-black text-gray-900 uppercase tracking-widest">Struk Pembayaran</h2>
                    <p class="text-xs text-gray-400 mt-1 font-bold uppercase tracking-tighter">
                        {{ config('app.name', 'Laravel POS') }}</p>
                </div>

                <!-- Transaction Info -->
                <div class="grid grid-cols-2 gap-6 mb-10">
                    <div>
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">No. Invoice
                        </div>
                        <div class="font-bold text-gray-900 text-sm">{{ $sale->invoice }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal</div>
                        <div class="font-bold text-gray-900 text-sm">{{ $sale->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Kasir</div>
                        <div class="font-bold text-gray-900 text-sm">{{ $sale->user->name }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</div>
                        <div class="font-black text-primary-600 text-sm italic">LUNAS</div>
                    </div>
                </div>

                <!-- Items -->
                <div class="space-y-4 mb-10">
                    <div
                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-50 pb-2 flex items-center gap-2">
                        <i class="fas fa-shopping-basket text-[8px]"></i> Rincian Item
                    </div>
                    <div class="divide-y divide-gray-50">
                        @foreach($sale->items as $item)
                            <div class="flex justify-between items-start py-3">
                                <div class="flex-1">
                                    <div class="text-sm font-bold text-gray-900">{{ $item->product->name }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                                        {{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="text-right text-sm font-black text-gray-900">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Footer Summary -->
                <div class="border-t-2 border-dashed border-gray-100 pt-8 space-y-4">
                    <div class="flex justify-between items-center px-2">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Subtotal</span>
                        <span class="font-bold text-gray-900">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
                    </div>
                    <div
                        class="flex justify-between items-center bg-primary-600 p-5 rounded-2xl shadow-lg shadow-primary-200">
                        <span class="text-white text-[10px] font-black uppercase tracking-widest">Total Bayar</span>
                        <span class="text-white text-2xl font-black">Rp
                            {{ number_format($sale->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="text-center mt-12 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] italic">
                    ~ Terima Kasih ~
                </div>

                <!-- Actions -->
                <div class="mt-12 flex flex-col gap-3 no-print">
                    <button onclick="window.print()" class="primary-btn w-full bg-gray-900 hover:bg-black">
                        <i class="fas fa-print mr-2"></i> CETAK STRUK
                    </button>
                    <a href="{{ route('pos.index') }}" class="primary-btn w-full text-center">
                        <i class="fas fa-shopping-cart mr-2"></i> KEMBALI KE KASIR
                    </a>
                </div>
            </div>
        </div>
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