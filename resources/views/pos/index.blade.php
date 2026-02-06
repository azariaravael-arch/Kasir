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
            padding: 1.5rem 2rem;
        }

        /* Page Title */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Layout Main */
        .pos-main {
            display: flex;
            flex: 1;
            overflow: hidden;
            padding: 1.5rem;
            gap: 1.5rem;
        }

        .products-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .checkout-section {
            width: 360px;
            background: white;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Search & Actions */
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-wrapper {
            position: relative;
            width: 300px;
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
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-transform: uppercase;
        }

        /* Product Grid */
        .product-grid {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1.25rem;
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-green);
        }

        .product-image-box {
            width: 100px;
            height: 100px;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .product-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .product-price {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-green);
        }

        /* Categories Bar */
        .categories-bar {
            display: flex;
            gap: 1rem;
            padding-top: 1rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .category-item {
            background: white;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            min-width: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid var(--border-color);
        }

        .category-item.active {
            border-color: var(--primary-green);
            color: var(--primary-green);
        }

        .category-item i {
            font-size: 1.2rem;
        }

        .category-item span {
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Checkout Sidebar */
        .checkout-header {
            padding: 1.5rem;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
        }

        .checkout-header h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .cart-list {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
            gap: 1rem;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: -0.01em;
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8faf9;
            padding: 4px 8px;
            border-radius: 50px;
            border: 1px solid #e8f2ee;
        }

        .qty-btn {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--primary-green);
            color: var(--primary-green);
            background: white;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            background: var(--primary-green);
            color: white;
        }

        .cart-item-price {
            font-weight: 900;
            color: var(--text-dark);
            min-width: 90px;
            text-align: right;
            font-size: 0.95rem;
        }

        .checkout-summary {
            padding: 1.5rem;
            background: #fafafa;
            border-radius: 0 0 12px 12px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .summary-row.total {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
            color: var(--primary-green);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn {
            padding: 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            text-align: center;
            transition: opacity 0.2s;
        }

        .btn-cancel {
            border: 1px solid #d9534f;
            color: #d9534f;
        }

        .pos-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 64px);
            overflow: hidden;
        }

        /* Layout Main */
        .pos-main {
            display: flex;
            flex: 1;
            overflow: hidden;
            gap: 1.5rem;
            padding: 0;
            padding-bottom: 1rem;
        }

        .btn-hold {
            border: 1px solid var(--primary-green);
            color: var(--primary-green);
        }

        .btn-pay {
            grid-column: span 2;
            background: var(--primary-green);
            color: white;
            font-size: 1.1rem;
            margin-top: 0.5rem;
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
    </style>

    <div class="pos-container px-6 py-4">
        <div class="page-header">
            <h1 class="text-2xl font-black text-gray-900 flex items-center gap-3">
                <i class="fas fa-shopping-cart text-primary-500"></i>
                Kasir
            </h1>
        </div>

        <!-- Main Content -->
        <main class="pos-main">
            <!-- Left: Products -->
            <section class="products-section">
                <div class="search-container">
                    <div class="add-item-btn cursor-pointer">
                        <span class="text-xl">+</span> Add New Item
                    </div>
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="search-input" placeholder="Search Items here...">
                        <button
                            class="absolute right-0 top-0 h-full w-12 bg-emerald-500 rounded-r-full text-white flex items-center justify-center">
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
                        <span class="text-green">Tax 10%</span>
                        <span id="tax" class="font-bold text-gray-700">Rp 0</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="total">Rp 0</span>
                    </div>

                    <div class="action-buttons">
                        <button onclick="cancelOrder()" class="btn btn-cancel">Cancel Order</button>
                        <button onclick="alert('Hold Order feature coming soon!')" class="btn btn-hold">Hold
                            Order</button>
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
            const taxValue = subtotalValue * 0.1;
            const totalValue = subtotalValue - (subtotalValue * (discountValue / 100)) + taxValue;

            document.getElementById('subtotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotalValue);
            document.getElementById('tax').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(taxValue);
            const formattedTotal = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.max(0, totalValue));
            document.getElementById('total').textContent = formattedTotal;
            document.getElementById('totalDisplay').textContent = formattedTotal;
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