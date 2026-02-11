<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --primary-green: #20a770;
            --light-bg: #edf5f2;
            --white: #ffffff;
            --text-dark: #333333;
            --text-muted: #888888;
            --border-color: #e0e0e0;
        }

        /* POS Container */
        .pos-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 64px);
            overflow: hidden;
            padding: 0.75rem 1rem;
        }

        @media (min-width: 768px) {
            .pos-container {
                padding: 1.5rem 2rem;
            }
        }

        /* Page Title */
        .page-header {
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        @media (min-width: 768px) {
            .page-header {
                margin-bottom: 2rem;
            }
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (min-width: 768px) {
            .page-title {
                font-size: 1.5rem;
                gap: 0.75rem;
            }
        }

        /* Layout Main */
        .pos-main {
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow: hidden;
            gap: 1rem;
            padding: 0;
        }

        @media (min-width: 1024px) {
            .pos-main {
                flex-direction: row;
                padding: 1rem;
                gap: 1.5rem;
            }
        }

        .products-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            overflow: hidden;
        }

        @media (min-width: 1024px) {
            .products-section {
                gap: 1.5rem;
            }
        }

        .checkout-section {
            width: 100%;
            height: 350px;
            background: white;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        @media (min-width: 1024px) {
            .checkout-section {
                width: 360px;
                height: auto;
                flex: 0 0 360px;
            }
        }

        /* Search & Actions */
        .search-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        @media (min-width: 768px) {
            .search-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                grid-template-columns: auto;
                gap: 1rem;
            }
        }

        .search-wrapper {
            position: relative;
            width: 100%;
        }

        @media (min-width: 768px) {
            .search-wrapper {
                width: 300px;
            }
        }

        .search-input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border-radius: 50px;
            border: 1px solid var(--border-color);
            background: white;
            font-size: 0.9rem;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .add-item-btn {
            color: var(--primary-green);
            font-weight: 600;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-transform: uppercase;
            padding: 0.5rem 1rem;
            background: #f0f9f6;
            border-radius: 8px;
            border: 1px solid var(--primary-green);
            cursor: pointer;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .add-item-btn {
                font-size: 0.85rem;
                justify-content: flex-start;
            }
        }

        /* Product Grid */
        .product-grid {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 0.75rem;
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        @media (min-width: 640px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
                gap: 1rem;
            }
        }

        @media (min-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 1.25rem;
            }
        }

        .product-card {
            background: white;
            border-radius: 12px;
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        @media (min-width: 768px) {
            .product-card {
                padding: 1rem;
            }
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-green);
        }

        .product-image-box {
            width: 70px;
            height: 70px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .product-image-box {
                width: 100px;
                height: 100px;
                margin-bottom: 0.75rem;
            }
        }

        .product-image-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .product-name {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
            line-clamp: 2;
        }

        @media (min-width: 768px) {
            .product-name {
                font-size: 0.9rem;
            }
        }

        .product-price {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary-green);
        }

        @media (min-width: 768px) {
            .product-price {
                font-size: 1rem;
            }
        }

        /* Categories Bar */
        .categories-bar {
            display: flex;
            gap: 0.75rem;
            padding-top: 0.75rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        @media (min-width: 768px) {
            .categories-bar {
                gap: 1rem;
                padding-top: 1rem;
            }
        }

        .category-item {
            background: white;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            min-width: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid var(--border-color);
            font-size: 0.75rem;
        }

        @media (min-width: 768px) {
            .category-item {
                padding: 0.75rem 1.5rem;
                min-width: 120px;
                gap: 0.5rem;
                font-size: 0.85rem;
            }
        }

        .category-item.active {
            border-color: var(--primary-green);
            color: var(--primary-green);
        }

        .category-item i {
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            .category-item i {
                font-size: 1.2rem;
            }
        }

        .category-item span {
            font-size: 0.7rem;
            font-weight: 500;
        }

        @media (min-width: 768px) {
            .category-item span {
                font-size: 0.85rem;
            }
        }

        /* Checkout Sidebar */
        .checkout-header {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
        }

        @media (min-width: 1024px) {
            .checkout-header {
                padding: 1.5rem;
            }
        }

        .checkout-header h2 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        @media (min-width: 1024px) {
            .checkout-header h2 {
                font-size: 1.2rem;
            }
        }

        .cart-list {
            flex: 1;
            overflow-y: auto;
            padding: 0.75rem;
        }

        @media (min-width: 1024px) {
            .cart-list {
                padding: 1rem;
            }
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
            gap: 0.75rem;
            font-size: 0.85rem;
        }

        @media (min-width: 1024px) {
            .cart-item {
                padding: 1rem 0;
                gap: 1rem;
                font-size: 0.95rem;
            }
        }

        .cart-item-info {
            flex: 1;
            min-width: 0;
        }

        .cart-item-name {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: -0.01em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (min-width: 1024px) {
            .cart-item-name {
                font-size: 0.95rem;
            }
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #f8faf9;
            padding: 2px 6px;
            border-radius: 50px;
            border: 1px solid #e8f2ee;
        }

        @media (min-width: 1024px) {
            .qty-controls {
                gap: 0.75rem;
                padding: 4px 8px;
            }
        }

        .qty-btn {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--primary-green);
            color: var(--primary-green);
            background: white;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s;
        }

        @media (min-width: 1024px) {
            .qty-btn {
                width: 28px;
                height: 28px;
                font-size: 16px;
            }
        }

        .qty-btn:hover {
            background: var(--primary-green);
            color: white;
        }

        .cart-item-price {
            font-weight: 900;
            color: var(--text-dark);
            min-width: 70px;
            text-align: right;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        @media (min-width: 1024px) {
            .cart-item-price {
                min-width: 90px;
                font-size: 0.95rem;
            }
        }

        .checkout-summary {
            padding: 1rem;
            background: #fafafa;
            border-radius: 0 0 12px 12px;
        }

        @media (min-width: 1024px) {
            .checkout-summary {
                padding: 1.5rem;
            }
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.3rem;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        @media (min-width: 1024px) {
            .summary-row {
                margin-bottom: 0.5rem;
                font-size: 0.9rem;
            }
        }

        .summary-row.total {
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #eee;
            color: var(--primary-green);
            font-weight: 700;
            font-size: 1rem;
        }

        @media (min-width: 1024px) {
            .summary-row.total {
                margin-top: 1rem;
                padding-top: 1rem;
                font-size: 1.2rem;
            }
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        @media (min-width: 1024px) {
            .action-buttons {
                gap: 1rem;
                margin-top: 1.5rem;
            }
        }

        .btn {
            padding: 0.6rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            text-align: center;
            transition: opacity 0.2s;
        }

        @media (min-width: 1024px) {
            .btn {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
        }

        .btn-cancel {
            border: 1px solid #d9534f;
            color: #d9534f;
        }

        .btn-hold {
            border: 1px solid var(--primary-green);
            color: var(--primary-green);
        }

        .btn-pay {
            grid-column: span 2;
            background: var(--primary-green);
            color: white;
            font-size: 0.95rem;
            margin-top: 0.25rem;
        }

        @media (min-width: 1024px) {
            .btn-pay {
                font-size: 1.1rem;
                margin-top: 0.5rem;
            }
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        .text-green {
            color: var(--primary-green);
        }

        @media (max-width: 768px) {
            .qty-value {
                font-size: 0.75rem;
            }
        }
    </style>

    <div class="pos-container px-3 sm:px-6 py-3 sm:py-4">
        <div class="page-header">
            <h1 class="text-lg sm:text-2xl font-black text-gray-900 flex items-center gap-2 sm:gap-3">
                <i class="fas fa-shopping-cart text-primary-500"></i>
                <span>Kasir</span>
            </h1>
            <a href="{{ route('pos.heldPage') }}" class="px-2 sm:px-3 py-1.5 sm:py-2 bg-emerald-500 text-white rounded text-xs sm:text-sm whitespace-nowrap">Held Orders</a>
        </div>

        <!-- Main Content -->
        <main class="pos-main">
            <!-- Left: Products -->
            <section class="products-section">
                <div class="search-container">
                    <div class="add-item-btn cursor-pointer">
                        <span class="text-lg">+</span> <span class="hidden sm:inline">Add New Item</span><span class="inline sm:hidden">Add</span>
                    </div>
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="search-input text-sm" placeholder="Search...">
                        <button
                            class="absolute right-0 top-0 h-full w-10 bg-emerald-500 rounded-r-full text-white flex items-center justify-center text-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="product-grid custom-scrollbar" id="productList">
                    @foreach($products as $p)
                        <div class="product-card product-item" data-id="{{ $p->id }}" data-name="{{ $p->name }}"
                            data-price="{{ $p->price }}" data-stock="{{ $p->stock }}" data-category="{{ $p->category }}"
                            onclick="addItem('{{ $p->id }}', '{{ addslashes($p->name) }}', {{ $p->price }}, {{ $p->stock }})">
                            <div class="product-image-box">
                                @if($p->image)
                                    <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}">
                                @else
                                    <div class="text-4xl opacity-30">📦</div>
                                @endif
                            </div>
                            <h3 class="product-name">{{ $p->name }}</h3>
                            <div class="product-price">Rp{{ number_format($p->price, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>

                <!-- Categories -->
                <div class="categories-bar no-scrollbar">
                    <div class="category-item active category-btn" data-category="All">
                        <i class="fas fa-coffee"></i>
                        <span>Semua</span>
                    </div>
                    @foreach($categories as $category)
                        <div class="category-item category-btn" data-category="{{ $category }}">
                            <i class="fas fa-utensils"></i>
                            <span>{{ $category }}</span>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Right: Checkout -->
            <aside class="checkout-section">

                <div class="cart-list custom-scrollbar" id="cartItems">
                    <div class="text-center py-10 text-gray-400 italic text-sm">
                        <p>Keranjang kosong</p>
                    </div>
                </div>

                <div class="checkout-summary">
                    <div class="summary-row">
                        <span>Discount (%)</span>
                        <input type="number" id="discount" value="0"
                            class="w-16 text-right border-none bg-transparent font-bold focus:ring-0 p-0" min="0">
                    </div>
                    <div class="summary-row">
                        <span>Sub Total</span>
                        <span id="subtotal" class="font-bold text-gray-700">Rp 0</span>
                    </div>
                    <div class="summary-row">
                        <span class="text-green">Tax <input type="number" id="taxPercent" value="10" min="0" max="100" class="w-12 text-right border-none bg-transparent font-bold focus:ring-0 p-0">%</span>
                        <span id="tax" class="font-bold text-gray-700">Rp 0</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="total">Rp 0</span>
                    </div>

                    <div class="action-buttons">
                        <button onclick="cancelOrder()" class="btn btn-cancel">Cancel Order</button>
                        <button onclick="holdOrder()" class="btn btn-hold">Hold Order</button>
                        <button onclick="checkout()" class="btn btn-pay">Pay (<span id="totalDisplay">Rp
                                0</span>)</button>
                    </div>
                </div>
            </aside>
        </main>
    </div>

    

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
                    b.classList.remove('active');
                });
                this.classList.add('active');

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

            if (items.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="text-center py-20 text-gray-400 italic">
                        <p>Keranjang masih kosong</p>
                    </div>
                `;
            } else {
                let html = '';
                items.forEach((item, index) => {
                    html += `
                        <div class="cart-item">
                            <div class="cart-item-info">
                                <div class="cart-item-name">${item.name}</div>
                            </div>
                            <div class="qty-controls">
                                <button onclick="updateQty(${index}, -1)" class="qty-btn">-</button>
                                <span class="font-black text-sm w-5 text-center">${item.qty}</span>
                                <button onclick="updateQty(${index}, 1)" class="qty-btn">+</button>
                            </div>
                            <div class="cart-item-price">Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.qty)}</div>
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
            const taxPercentValue = parseInt(document.getElementById('taxPercent').value) || 0;
            const taxValue = subtotalValue * (taxPercentValue / 100);
            const totalValue = subtotalValue - (subtotalValue * (discountValue / 100)) + taxValue;

            document.getElementById('subtotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotalValue);
            document.getElementById('tax').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(taxValue);
            const formattedTotal = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.max(0, totalValue));
            document.getElementById('total').textContent = formattedTotal;
            document.getElementById('totalDisplay').textContent = formattedTotal;
        }

        document.getElementById('discount').addEventListener('input', updateTotal);
        document.getElementById('taxPercent').addEventListener('input', updateTotal);

        function checkout() {
            if (items.length === 0) return alert('Pilih produk terlebih dahulu!');
            if (!confirm('Lanjutkan proses pembayaran dan cetak struk?')) return;

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const taxPercent = parseInt(document.getElementById('taxPercent').value) || 0;
            fetch('{{ route('pos.store') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({ items: items, tax_percent: taxPercent })
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

        // Hold order: send items to backend and clear cart
        function holdOrder() {
            if (items.length === 0) return alert('Pilih produk terlebih dahulu!');
            if (!confirm('Hold order ini?')) return;

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const taxPercent = parseInt(document.getElementById('taxPercent').value) || 0;
            fetch('{{ route('pos.hold') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({ items: items, tax_percent: taxPercent })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        items = [];
                        updateCart();
                        alert('Order berhasil di-hold');
                    } else {
                        alert('Gagal: ' + data.message);
                    }
                })
                .catch(err => alert('Gagal memproses hold order'));
        }
        // Load picked-up resumed cart from localStorage on page load
        document.addEventListener('DOMContentLoaded', function () {
            try {
                const stored = localStorage.getItem('pos_items');
                if (stored) {
                    const parsed = JSON.parse(stored);
                    if (Array.isArray(parsed) && parsed.length > 0) {
                        items = parsed;
                        updateCart();
                    }
                    localStorage.removeItem('pos_items');
                }
            } catch (e) {
                console.error('Failed to load stored cart', e);
            }
        });
    </script>
</x-app-layout>