<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary: #2563eb;
            --primary-light: #eff6ff;
            --primary-dark: #1d4ed8;
            --gray-bg: #f9fafb;
            --white: #ffffff;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05);
            --radius-lg: 20px;
            --radius-md: 16px;
            --radius-sm: 12px;
        }

        /* LAYOUT MENTOK KE ATAS - TANPA PADDING ATAS */
        .pos-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 64px); /* Tepat di bawah navbar */
            background: var(--gray-bg);
            padding: 0; /* NO PADDING - MENTOK KE ATAS */
            overflow: hidden;
        }

        /* HEADER DIHAPUS - TIDAK ADA TULISAN KASIR */

        /* ===== LAYOUT 3 KOLOM ===== */
        .pos-main {
            display: grid;
            grid-template-columns: 220px 1fr 380px;
            gap: 1.25rem;
            flex: 1;
            overflow: hidden;
            min-height: 0;
            padding: 1.25rem; /* Padding hanya di dalam, bukan di container */
        }

        /* ===== KOLOM 1: FILTER KATEGORI VERTIKAL ===== */
        .category-filter {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            overflow-y: auto;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .filter-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            font-weight: 700;
            margin-bottom: 0.75rem;
            padding-left: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .category-vertical-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            border-radius: var(--radius-sm);
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .category-vertical-item i {
            width: 20px;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .category-vertical-item:hover {
            background: #f3f4f6;
            border-color: var(--border-color);
        }

        .category-vertical-item.active {
            background: var(--primary-light);
            border-color: var(--primary);
            color: var(--primary-dark);
            font-weight: 600;
        }

        .category-vertical-item.active i {
            color: var(--primary);
        }

        .category-count {
            margin-left: auto;
            background: #e5e7eb;
            padding: 0.15rem 0.6rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .category-vertical-item.active .category-count {
            background: var(--primary);
            color: white;
        }

        /* ===== KOLOM 2: GRID PRODUK KOTAK ===== */
        .product-section {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.25rem 1.25rem;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .search-wrapper {
            position: relative;
            margin-bottom: 1.25rem;
            flex-shrink: 0;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border-radius: 50px;
            border: 1.5px solid var(--border-color);
            background: #f9fafb;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .search-input:focus {
            border-color: var(--primary);
            background: white;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* GRID PRODUK - KOTAK SEMPURNA */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            overflow-y: auto;
            padding-right: 0.5rem;
            padding-bottom: 0.25rem;
        }

        .product-card {
            background: white;
            border-radius: var(--radius-md);
            padding: 1rem 0.75rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 1.5px solid var(--border-color);
            transition: all 0.2s;
            cursor: pointer;
        }

        .product-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .product-image-box {
            width: 80px;
            height: 80px;
            background: #f3f4f6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
        }

        .product-image-box img {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }

        .product-image-box i {
            font-size: 2.2rem;
            color: var(--primary);
            opacity: 0.6;
        }

        .product-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
            min-height: 2.4rem;
        }

        .product-price {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--primary);
            background: var(--primary-light);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            margin-bottom: 0.35rem;
        }

        .product-stock {
            font-size: 0.65rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* ===== KOLOM 3: CARD KASIR ===== */
        .cashier-card {
            background: white;
            border-radius: var(--radius-lg);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            height: 100%;
        }

        /* HEADER CARD KASIR - TANPA TITLE KASIR */
        .cashier-header {
            background: var(--primary-dark);
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cashier-header h3 {
            color: white;
            font-size: 1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin: 0;
        }

        .cashier-header h3 i {
            font-size: 1.1rem;
        }

        /* BUTTON HELD DIPINDAHKAN KE SINI */
        .held-order-btn {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.2s;
            cursor: pointer;
        }

        .held-order-btn:hover {
            background: white;
            color: var(--primary-dark);
            border-color: white;
        }

        /* Cart Items */
        .cart-list {
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem 1rem;
            background: #fafbfc;
            max-height: calc(100vh - 280px);
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background: white;
            border-radius: var(--radius-sm);
            margin-bottom: 0.75rem;
            border: 1px solid var(--border-color);
            transition: all 0.2s;
        }

        .cart-item:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .cart-item-info {
            flex: 1;
            min-width: 0;
        }

        .cart-item-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cart-item-price {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: white;
            padding: 0.2rem;
            border-radius: 50px;
            border: 1px solid var(--border-color);
            margin: 0 0.5rem;
        }

        .qty-btn {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: #f3f4f6;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            background: var(--primary);
            color: white;
        }

        .qty-value {
            font-weight: 700;
            font-size: 0.85rem;
            min-width: 22px;
            text-align: center;
        }

        .cart-item-subtotal {
            font-weight: 700;
            color: var(--primary);
            font-size: 0.85rem;
            min-width: 65px;
            text-align: right;
        }

        /* Payment Summary */
        .payment-summary {
            padding: 1.25rem 1.25rem 0.75rem;
            background: white;
            border-top: 1px solid var(--border-color);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.6rem;
            font-size: 0.85rem;
        }

        .summary-row.total {
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 2px solid var(--border-color);
            font-size: 1rem;
            font-weight: 800;
        }

        .summary-label {
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .summary-label i {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .summary-value {
            font-weight: 700;
            color: var(--text-dark);
        }

        .total-value {
            color: var(--primary);
            font-size: 1.2rem;
            font-weight: 800;
        }

        .input-group {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .summary-input {
            width: 60px;
            padding: 0.3rem 0.4rem;
            border: 1.5px solid var(--border-color);
            border-radius: 6px;
            font-weight: 600;
            text-align: right;
            background: #f9fafb;
            font-size: 0.8rem;
        }

        .summary-input:focus {
            border-color: var(--primary);
            outline: none;
        }

        /* Action Buttons */
        .cashier-actions {
            display: flex;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem 1.25rem;
        }

        .btn {
            padding: 0.7rem 0.8rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            flex: 1;
        }

        .btn-hold {
            background: #f3f4f6;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        .btn-hold:hover {
            background: #e5e7eb;
        }

        .btn-cancel {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .btn-cancel:hover {
            background: #dc2626;
            color: white;
        }

        .btn-pay {
            background: var(--primary);
            color: white;
            font-size: 0.9rem;
            padding: 0.8rem;
        }

        .btn-pay:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        /* Empty Cart */
        .empty-cart {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 180px;
            color: var(--text-muted);
            text-align: center;
        }

        .empty-cart i {
            font-size: 2.8rem;
            color: var(--border-color);
            margin-bottom: 0.75rem;
        }

        .empty-cart p {
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .pos-main {
                grid-template-columns: 200px 1fr 340px;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            }
        }

        @media (max-width: 1024px) {
            .pos-main {
                grid-template-columns: 180px 1fr 320px;
            }
        }
    </style>

    <div class="pos-container">
        <!-- TIDAK ADA HEADER/TULISAN KASIR - MENTOK KE ATAS -->
        
        <!-- Main: 3 Kolom -->
        <main class="pos-main">
            
            <!-- ===== KOLOM 1: FILTER KATEGORI VERTIKAL ===== -->
            <div class="category-filter custom-scrollbar">
                <div class="filter-title">
                    <i class="fas fa-filter"></i> KATEGORI PRODUK
                </div>
                
                <div class="category-vertical-item active">
                    <i class="fas fa-box"></i>
                    <span>Semua Produk</span>
                    <span class="category-count">{{ $products->count() }}</span>
                </div>
                
                @foreach($categories as $category)
                <div class="category-vertical-item category-btn" data-category="{{ $category->name }}">
                    <i class="fas fa-tag"></i>
                    <span>{{ $category->name }}</span>
                    <span class="category-count">
                        {{ $category->products_count ?? $category->products?->count() ?? 0 }}
                    </span>
                </div>
                @endforeach
                
                <div style="margin-top: auto; padding-top: 1rem;">
                    <div class="filter-title">
                        <i class="fas fa-cog"></i> PENGATURAN
                    </div>
                    <div class="category-vertical-item">
                        <i class="fas fa-clock"></i>
                        <span>Riwayat</span>
                    </div>
                </div>
            </div>

            <!-- ===== KOLOM 2: GRID PRODUK KOTAK ===== -->
            <div class="product-section">
                <!-- Search -->
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari produk atau menu...">
                </div>

                <!-- Product Grid - Kotak -->
                <div class="product-grid custom-scrollbar" id="productList">
                    @foreach($products as $p)
                    <div class="product-card product-item" 
                         data-id="{{ $p->id }}" 
                         data-name="{{ $p->name }}"
                         data-price="{{ $p->price }}" 
                         data-stock="{{ $p->stock }}" 
                         data-category="{{ $p->categoryRelation?->name ?? 'Uncategorized' }}"
                         onclick="addItem('{{ $p->id }}', '{{ addslashes($p->name) }}', {{ $p->price }}, {{ $p->stock }})">
                        <div class="product-image-box">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}">
                            @else
                                <i class="fas fa-box"></i>
                            @endif
                        </div>
                        <h3 class="product-name">{{ $p->name }}</h3>
                        <div class="product-price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                        <div class="product-stock">
                            <i class="fas fa-cubes"></i> {{ $p->stock }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- ===== KOLOM 3: CARD KASIR ===== -->
            <div class="cashier-card">
                <!-- HEADER CARD KASIR + BUTTON HELD -->
                <div class="cashier-header">
                    <h3>
                        <i class="fas fa-credit-card"></i>
                        Pembayaran
                    </h3>
                    <!-- BUTTON HELD DIPINDAHKAN KE SINI -->
                    <a href="{{ route('pos.heldPage') }}" class="held-order-btn">
                        <i class="fas fa-clock"></i>
                        Held Orders
                    </a>
                </div>

                <!-- Cart Items -->
                <div class="cart-list custom-scrollbar" id="cartItems">
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Keranjang masih kosong</p>
                        <p style="font-size: 0.7rem; margin-top: 0.4rem; color: #9ca3af;">Klik produk untuk menambah</p>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="payment-summary">
                    <div class="summary-row">
                        <span class="summary-label">
                            <i class="fas fa-tag"></i> Diskon
                        </span>
                        <div class="input-group">
                            <input type="number" id="discount" value="0" class="summary-input" min="0" max="100" step="1">
                            <span style="color: var(--text-muted); font-size: 0.8rem;">%</span>
                        </div>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">
                            <i class="fas fa-calculator"></i> Sub Total
                        </span>
                        <span id="subtotal" class="summary-value">Rp 0</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">
                            <i class="fas fa-percent"></i> Pajak
                        </span>
                        <div class="input-group">
                            <input type="number" id="taxPercent" value="10" class="summary-input" min="0" max="100" step="1">
                            <span style="color: var(--text-muted); font-size: 0.8rem;">%</span>
                        </div>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">
                            <i class="fas fa-file-invoice"></i> Nilai Pajak
                        </span>
                        <span id="tax" class="summary-value">Rp 0</span>
                    </div>

                    <div class="summary-row total">
                        <span class="summary-label">TOTAL</span>
                        <span id="total" class="total-value">Rp 0</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="cashier-actions">
                    <button onclick="holdOrder()" class="btn btn-hold">
                        <i class="fas fa-pause-circle"></i> Hold
                    </button>
                    <button onclick="cancelOrder()" class="btn btn-cancel">
                        <i class="fas fa-times-circle"></i> Batal
                    </button>
                    <button onclick="checkout()" class="btn btn-pay">
                        <i class="fas fa-check-circle"></i> Bayar
                    </button>
                </div>
                
                <!-- Total Display untuk Button Bayar (Hidden) -->
                <span id="totalDisplay" style="display: none;">Rp 0</span>
            </div>
        </main>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        let items = [];
        let currentCategory = 'All';

        // Format currency
        function formatCurrency(value) {
            const formatter = new Intl.NumberFormat('id-ID', { 
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            return 'Rp ' + formatter.format(Math.round(value));
        }

        // Filter produk
        function filterProducts() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const products = document.querySelectorAll('.product-item');

            products.forEach(p => {
                const name = p.dataset.name.toLowerCase();
                const category = p.dataset.category;
                const matchesSearch = name.includes(query);
                const matchesCategory = (currentCategory === 'All' || category === currentCategory);
                p.style.display = matchesSearch && matchesCategory ? '' : 'none';
            });
        }

        document.getElementById('searchInput').addEventListener('input', filterProducts);

        // Kategori vertikal
        document.querySelectorAll('.category-vertical-item').forEach((btn, index) => {
            btn.addEventListener('click', function() {
                if (this.querySelector('.filter-title')) return;
                
                document.querySelectorAll('.category-vertical-item').forEach(b => {
                    if (!b.querySelector('.filter-title')) {
                        b.classList.remove('active');
                    }
                });
                this.classList.add('active');
                
                if (index === 1) {
                    currentCategory = 'All';
                } else {
                    const categorySpan = this.querySelector('span:nth-child(2)');
                    currentCategory = categorySpan ? categorySpan.textContent : 'All';
                }
                
                filterProducts();
            });
        });

        // Add item
        function addItem(productId, name, price, stock) {
            const existing = items.find(i => i.product_id == productId);
            if (existing) {
                if (existing.qty < stock) {
                    existing.qty++;
                } else {
                    alert('Stok tidak mencukupi!');
                    return;
                }
            } else {
                items.push({ product_id: productId, name, price, qty: 1, stock });
            }
            updateCart();
        }

        // Update cart
        function updateCart() {
            const cartContainer = document.getElementById('cartItems');
            
            if (items.length === 0) {
                cartContainer.innerHTML = `
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Keranjang masih kosong</p>
                        <p style="font-size: 0.7rem; margin-top: 0.4rem; color: #9ca3af;">Klik produk untuk menambah</p>
                    </div>
                `;
            } else {
                let html = '';
                items.forEach((item, index) => {
                    html += `
                        <div class="cart-item">
                            <div class="cart-item-info">
                                <div class="cart-item-name">${item.name}</div>
                                <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</div>
                            </div>
                            <div class="qty-controls">
                                <button onclick="updateQty(${index}, -1)" class="qty-btn">−</button>
                                <span class="qty-value">${item.qty}</span>
                                <button onclick="updateQty(${index}, 1)" class="qty-btn">+</button>
                            </div>
                            <div class="cart-item-subtotal">Rp ${(item.price * item.qty).toLocaleString('id-ID')}</div>
                        </div>
                    `;
                });
                cartContainer.innerHTML = html;
            }
            updateTotal();
        }

        // Update quantity
        function updateQty(index, change) {
            const item = items[index];
            const newQty = item.qty + change;
            if (newQty < 1) {
                items.splice(index, 1);
                updateCart();
            } else if (newQty <= item.stock) {
                item.qty = newQty;
                updateCart();
            } else {
                alert('Stok tidak mencukupi');
            }
        }

        // Cancel order
        function cancelOrder() {
            if (items.length > 0 && confirm('Kosongkan keranjang?')) {
                items = [];
                updateCart();
            }
        }

        // Update total
        function updateTotal() {
            const subtotalValue = items.reduce((sum, i) => sum + (i.qty * i.price), 0);
            const discountValue = parseInt(document.getElementById('discount').value) || 0;
            const taxPercentValue = parseInt(document.getElementById('taxPercent').value) || 0;
            const taxValue = subtotalValue * (taxPercentValue / 100);
            const totalValue = subtotalValue - (subtotalValue * (discountValue / 100)) + taxValue;

            document.getElementById('subtotal').textContent = formatCurrency(subtotalValue);
            document.getElementById('tax').textContent = formatCurrency(taxValue);
            const formattedTotal = formatCurrency(Math.max(0, totalValue));
            document.getElementById('total').textContent = formattedTotal;
            document.getElementById('totalDisplay').textContent = formattedTotal;
        }

        document.getElementById('discount').addEventListener('input', updateTotal);
        document.getElementById('taxPercent').addEventListener('input', updateTotal);

        // Checkout
        function checkout() {
            if (items.length === 0) return alert('Pilih produk terlebih dahulu!');
            if (!confirm('Lanjutkan pembayaran?')) return;

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const taxPercent = parseInt(document.getElementById('taxPercent').value) || 0;
            
            fetch('{{ route('pos.store') }}', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': token 
                },
                body: JSON.stringify({ items: items, tax_percent: taxPercent })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    items = [];
                    updateCart();
                    window.location.href = `/pos/${data.sale_id}/receipt`;
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(err => alert('Gagal memproses transaksi'));
        }

        // Hold order
        function holdOrder() {
            if (items.length === 0) return alert('Pilih produk terlebih dahulu!');
            if (!confirm('Hold order ini?')) return;

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const taxPercent = parseInt(document.getElementById('taxPercent').value) || 0;
            
            fetch('{{ route('pos.hold') }}', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': token 
                },
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
            .catch(err => alert('Gagal hold order'));
        }

        // Load stored cart
        document.addEventListener('DOMContentLoaded', function() {
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
            
            // Set active category ke "Semua Produk"
            const allCategory = document.querySelector('.category-vertical-item.active');
            if (allCategory) {
                currentCategory = 'All';
            }
        });
    </script>
</x-app-layout>