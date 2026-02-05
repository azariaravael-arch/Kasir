<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-[calc(100vh-64px)] overflow-hidden">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Main Content (Products) -->
                <div class="flex-1 flex flex-col h-[calc(100vh-160px)]">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="relative flex-1">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                                <input type="text" id="searchInput" placeholder="Cari nama produk..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
                                <button class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-blue-600 text-white category-btn active" data-category="All">Semua</button>
                                @foreach($categories as $category)
                                    <button class="px-4 py-2 rounded-lg text-sm font-bold transition-colors bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 category-btn" data-category="{{ $category }}">{{ $category }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Products Area (Grid 2-Row Slide) -->
                    <div class="flex-1 overflow-x-auto overflow-y-hidden snap-x snap-mandatory custom-scrollbar-h pb-4 min-h-[460px]">
                        <div class="grid grid-rows-2 grid-flow-col gap-4 h-full w-max" id="productList" style="grid-template-rows: repeat(2, 210px); grid-auto-flow: column;">
                            @foreach($products as $p)
                                  <div class="product-item group bg-white border border-gray-200 rounded-2xl overflow-hidden cursor-pointer hover:shadow-xl hover:border-blue-500 transition-all active:scale-[0.98] flex flex-col snap-start shrink-0 shadow-sm" 
                                     style="width: 150px; min-width: 150px; height: 210px;"
                                     data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->price }}" 
                                     data-stock="{{ $p->stock }}" data-category="{{ $p->category }}"
                                     onclick="addItem('{{ $p->id }}', '{{ addslashes($p->name) }}', {{ $p->price }}, {{ $p->stock }})">
                                    
                                    <!-- Fixed Height Image Container -->
                                    <div class="h-[120px] w-full bg-gray-50 flex items-center justify-center overflow-hidden border-b border-gray-100">
                                        @if($p->image)
                                            <img src="{{ asset('storage/'.$p->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-3xl opacity-20">📦</span>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="p-3 flex flex-col justify-between flex-1">
                                        <div>
                                            <h4 class="text-gray-950 font-bold text-xs leading-tight line-clamp-2">{{ $p->name }}</h4>
                                            <p class="text-[9px] text-gray-400 font-bold mt-1">Stok: {{ $p->stock }}</p>
                                        </div>
                                        <div class="text-blue-800 font-black text-sm">
                                            Rp{{ number_format($p->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar (Order Summary) -->
                <div class="w-full lg:w-[400px] no-print-sidebar">
                    <div id="printArea" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-8 flex flex-col h-full">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Checkout</h3>
                            <span id="itemCount" class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">0 Item</span>
                        </div>

                        <div id="cartItems" class="flex-1 overflow-y-auto pr-2 custom-scrollbar mb-4 min-h-0">
                            <div class="text-center py-10 text-gray-400 italic text-sm">
                                <p>Keranjang kosong</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-6 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 font-bold">Subtotal</span>
                                <span id="subtotal" class="font-bold text-gray-900">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-sm no-print">
                                <span class="text-gray-500 font-bold">Diskon</span>
                                <input type="number" id="discount" value="0" class="w-24 text-right border-gray-300 rounded-md text-sm focus:ring-blue-800 p-1" min="0">
                            </div>
                            <div class="flex justify-between text-sm border-b border-gray-100 pb-3">
                                <span class="text-gray-500 font-bold">Pajak (10%)</span>
                                <span id="tax" class="font-bold text-gray-900">Rp 0</span>
                            </div>
                            
                            <div class="pt-4 flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900 uppercase">TOTAL</span>
                                <span id="total" class="text-2xl font-bold text-gray-900">Rp 0</span>
                            </div>

                             <div class="no-print grid grid-cols-2 gap-2 mt-4">
                                 <button onclick="cancelOrder()"
                                     class="py-2.5 bg-white text-gray-700 rounded-lg font-bold text-[10px] uppercase border border-red-500 hover:bg-red-50 transition active:scale-95 shadow-sm">
                                     CANCEL
                                 </button>
                                 <button onclick="checkout()"
                                     class="py-2.5 bg-white text-gray-900 rounded-lg font-bold text-[10px] uppercase border border-blue-600 hover:bg-blue-50 transition active:scale-95 shadow-sm">
                                     PRINT RECEIPT
                                 </button>
                             </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .custom-scrollbar-h::-webkit-scrollbar {
            height: 5px;
        }

        .custom-scrollbar-h::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scrollbar-h::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar-h::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printArea,
            #printArea * {
                visibility: visible;
            }

            #printArea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none;
                box-shadow: none;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            img {
                display: none !important;
            }
        }
    </style>

    <script>
        let items = [];
        let currentCategory = 'All';

        function filterProducts() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const products = document.querySelectorAll('.product-item');

            products.forEach(p => {
                const name = p.dataset.name.toLowerCase();
                const category = p.dataset.category;
                const matchesSearch = name.includes(query);
                const matchesCategory = (currentCategory === 'All' || category === currentCategory);

                if (matchesSearch && matchesCategory) {
                    p.style.display = '';
                } else {
                    p.style.display = 'none';
                }
            });
        }

        document.getElementById('searchInput').addEventListener('input', filterProducts);

        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.category-btn').forEach(b => {
                    b.classList.remove('bg-blue-800', 'text-white');
                    b.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300');
                });
                this.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-300');
                this.classList.add('bg-blue-800', 'text-white');

                currentCategory = this.dataset.category;
                filterProducts();
            });
        });

        function addItem(productId, name, price, stock) {
            const existing = items.find(i => i.product_id == productId);
            if (existing) {
                if (existing.qty < stock) {
                    existing.qty++;
                } else {
                    alert('Maaf, stok tidak mencukupi');
                    return;
                }
            } else {
                items.push({ product_id: productId, name, price, qty: 1, stock });
            }
            updateCart();
        }

        function updateCart() {
            const cartItemsContainer = document.getElementById('cartItems');
            const itemCount = document.getElementById('itemCount');
            const totalQty = items.reduce((sum, i) => sum + i.qty, 0);
            itemCount.textContent = `${totalQty} Item`;

            if (items.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="text-center py-12 text-gray-400 italic">
                        <p>Keranjang masih kosong</p>
                    </div>
                `;
            } else {
                let html = '';
                items.forEach((item, index) => {
                    html += `
                        <div class="flex items-center justify-between gap-4 p-3 bg-gray-50 rounded-lg mb-2">
                            <div class="flex-1 overflow-hidden">
                                <h5 class="text-sm font-bold text-gray-900 truncate">${item.name}</h5>
                                <p class="text-gray-900 font-bold text-xs">Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.qty)}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="updateQty(${index}, -1)" class="w-6 h-6 flex items-center justify-center bg-white border border-gray-300 rounded text-gray-600 hover:bg-gray-100 font-bold">-</button>
                                <span class="text-xs font-bold w-4 text-center">${item.qty}</span>
                                <button onclick="updateQty(${index}, 1)" class="w-6 h-6 flex items-center justify-center bg-white border border-gray-300 rounded text-gray-600 hover:bg-gray-100 font-bold">+</button>
                                <button onclick="removeItem(${index})" class="ml-2 text-gray-400 hover:text-red-500 font-bold">×</button>
                            </div>
                        </div>
                    `;
                });
                cartItemsContainer.innerHTML = html;
            }
            updateTotal();
        }

        function updateQty(index, change) {
            const item = items[index];
            const newQty = item.qty + change;
            if (newQty < 1) removeItem(index);
            else if (newQty <= item.stock) {
                item.qty = newQty;
                updateCart();
            } else {
                alert('Stok tidak mencukupi');
            }
        }

        function removeItem(index) {
            items.splice(index, 1);
            updateCart();
        }

        function cancelOrder() {
            if (items.length > 0 && confirm('Kosongkan keranjang?')) {
                items = [];
                updateCart();
            }
        }

        function updateTotal() {
            const subtotalValue = items.reduce((sum, i) => sum + (i.qty * i.price), 0);
            const discountValue = parseInt(document.getElementById('discount').value) || 0;
            const taxValue = subtotalValue * 0.1;
            const totalValue = subtotalValue - discountValue + taxValue;

            document.getElementById('subtotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotalValue);
            document.getElementById('tax').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(taxValue);
            document.getElementById('total').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.max(0, totalValue));
        }

        document.getElementById('discount').addEventListener('input', updateTotal);

        function checkout() {
            if (items.length === 0) return alert('Pilih produk terlebih dahulu!');
            if (!confirm('Lanjutkan proses pembayaran dan cetak struk?')) return;

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('{{ route('pos.store') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({ items: items })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        items = [];
                        updateCart();
                        window.location.href = `/pos/${data.sale_id}/receipt`;
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(err => alert('Gagal memproses transaksi'));
        }
    </script>
</x-app-layout>