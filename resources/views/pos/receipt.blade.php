<x-print-layout>
    <div class="py-10 bg-gray-50/50 min-h-[calc(100vh-64px)] flex items-center justify-center">
        <!-- Thermal Receipt Container (80mm width = ~320px) -->
        <div class="bg-white p-0" style="width: 320px; font-family: 'Courier New', monospace;">
            
            <!-- Receipt Paper -->
            <div class="p-4 text-center text-xs" id="receiptContent">
                
                <!-- Header -->
                <div class="mb-4 border-b border-black pb-3">
                    <div class="font-bold text-sm mb-1">{{ config('app.name', 'KASIR') }}</div>
                    <div class="text-[11px] font-bold">STRUK PEMBAYARAN</div>
                    <div class="text-[10px] text-gray-600">Ama Pos</div>
                </div>

                <!-- Transaction Info -->
                <div class="mb-4 text-[11px] space-y-1 border-b border-black pb-3">
                    <div class="flex justify-between">
                        <span class="font-bold">Invoice:</span>
                        <span>{{ $sale->invoice }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-bold">Tanggal:</span>
                        <span>{{ $sale->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-bold">Kasir:</span>
                        <span>{{ $sale->user->name }}</span>
                    </div>
                </div>

                <!-- Items Header -->
                <div class="mb-2 text-[10px] font-bold border-b border-gray-400 pb-1">
                    <div class="flex justify-between">
                        <span>ITEM</span>
                        <span>QTY x HARGA</span>
                        <span>SUBTOTAL</span>
                    </div>
                </div>

                <!-- Items List -->
                <div class="mb-4 text-[10px] space-y-1">
                    @foreach($sale->items as $item)
                        <div class="border-b border-dotted border-gray-300 pb-1">
                            <div class="font-bold text-left">{{ $item->product->name }}</div>
                            <div class="flex justify-between text-[9px]">
                                <span>{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                <span class="font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Separator -->
                <div class="border-b-2 border-black my-3"></div>

                <!-- Summary -->
                <div class="mb-4 text-[11px] space-y-2">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span class="font-bold">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pajak (10%)</span>
                        <span class="font-bold">Rp {{ number_format($sale->total * 0.1, 0, ',', '.') }}</span>
                    </div>
                    <div class="bg-black text-white p-2 rounded flex justify-between font-bold text-[12px]">
                        <span>TOTAL</span>
                        <span>Rp {{ number_format($sale->total * 1.1, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Separator -->
                <div class="border-b-2 border-black my-3"></div>

                <!-- Footer -->
                <div class="text-[10px] space-y-1 text-center">
                    <div class="font-bold">PEMBAYARAN DITERIMA</div>
                    <div class="text-gray-600 text-[9px] italic">Terima kasih atas pembelian Anda</div>
                    <div class="mt-2 text-[9px] text-gray-500">{{ now()->format('d/m/Y H:i:s') }}</div>
                </div>

                <!-- Blank Space for thermal printer -->
                <div class="mt-8 mb-12"></div>

            </div>

            <!-- Actions (No Print) -->
            <div class="mt-6 px-4 space-y-3 no-print flex flex-col">
                <button onclick="window.print()" class="w-full px-4 py-2 bg-black text-white font-bold rounded hover:bg-gray-800 flex items-center justify-center gap-2">
                    <i class="fas fa-print"></i> CETAK STRUK
                </button>
                <a href="{{ route('pos.index') }}" class="w-full px-4 py-2 border-2 border-black text-black font-bold rounded text-center hover:bg-gray-100 flex items-center justify-center gap-2">
                    <i class="fas fa-shopping-cart"></i> KEMBALI KE KASIR
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 80mm;
                background: white;
            }

            .no-print {
                display: none !important;
            }

            #receiptContent {
                width: 80mm;
                padding: 0;
                margin: 0;
                page-break-after: always;
                text-align: center;
                font-family: 'Courier New', monospace;
                font-size: 11px;
                line-height: 1.2;
            }

            * {
                box-shadow: none !important;
                text-shadow: none !important;
                border-radius: 0 !important;
            }

            img {
                display: none !important;
            }

            @page {
                size: 80mm auto;
                margin: 0;
            }
        }

        @media screen {
            #receiptContent {
                background: white;
                border: 2px dashed #ccc;
            }
        }
    </style>
</x-print-layout>