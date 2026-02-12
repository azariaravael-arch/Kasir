<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

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
            --primary-soft: #dbeafe;
            --gray-bg: #f9fafb;
            --white: #ffffff;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --text-light: #9ca3af;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
        }

        body {
            background: var(--gray-bg);
        }

        /* LAYOUT MENTOK KE ATAS */
        .held-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 64px);
            overflow: hidden;
            padding: 0;
        }

        .held-main {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 2rem;
        }

        /* HEADER */
        .held-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
            flex-shrink: 0;
        }

        .held-title-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .held-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .held-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.01em;
        }

        .held-title span {
            color: var(--primary);
            background: var(--primary-light);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 0.75rem;
        }

        /* BACK BUTTON */
        .back-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: white;
            border: 1.5px solid var(--border-color);
            border-radius: 50px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .back-btn:hover {
            border-color: var(--primary);
            background: var(--primary-light);
            color: var(--primary-dark);
            transform: translateX(-3px);
        }

        .back-btn i {
            font-size: 0.8rem;
        }

        /* STATS CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 1.5px solid var(--border-color);
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .stat-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background: var(--primary-light);
            color: var(--primary);
        }

        .stat-info h4 {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }

        .stat-info .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .stat-info .stat-label {
            font-size: 0.75rem;
            color: var(--text-light);
        }

        /* SEARCH SECTION - ONLY SEARCH, NO FILTER TABS */
        .search-section {
            background: white;
            border-radius: var(--radius-xl);
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            border: 1.5px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .search-box {
            position: relative;
            width: 320px;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .search-box input {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 2.5rem;
            border-radius: 50px;
            border: 1.5px solid var(--border-color);
            background: #f9fafb;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .search-box input:focus {
            border-color: var(--primary);
            background: white;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* GRID HELD ORDERS */
        .held-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 1.25rem;
        }

        /* CARD HELD */
        .held-card {
            background: white;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
        }

        .held-card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .held-card-header {
            padding: 1.25rem 1.25rem 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px dashed var(--border-color);
        }

        .invoice-badge {
            display: flex;
            flex-direction: column;
        }

        .invoice-number {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .invoice-number i {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .invoice-date {
            font-size: 0.7rem;
            color: var(--text-light);
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-badge {
            background: #fffbeb;
            color: #f59e0b;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            border: 1px solid #fcd34d;
        }

        .held-card-body {
            padding: 1rem 1.25rem;
            flex: 1;
        }

        /* ITEMS PREVIEW */
        .items-preview {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            margin-bottom: 1rem;
        }

        .preview-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
        }

        .preview-item-name {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .item-qty-badge {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 0.15rem 0.5rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .item-price {
            font-weight: 600;
            color: var(--text-dark);
        }

        .more-items {
            font-size: 0.75rem;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.25rem;
        }

        .more-items i {
            color: var(--primary);
            font-size: 0.7rem;
        }

        /* TOTAL SECTION */
        .total-section {
            background: var(--primary-light);
            border-radius: var(--radius-md);
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem;
            border: 1px solid var(--primary-soft);
        }

        .total-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .total-value {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        /* CARD FOOTER - ONLY 2 BUTTONS */
        .held-card-footer {
            padding: 1rem 1.25rem 1.25rem;
            background: #fafbfc;
            border-top: 1px solid var(--border-color);
        }

        .action-buttons {
            display: flex;
            gap: 0.6rem;
            width: 100%;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.6rem 1rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            flex: 1;
        }

        .btn-resume {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .btn-resume:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-receipt {
            background: white;
            color: var(--text-dark);
            border: 1.5px solid var(--border-color);
        }

        .btn-receipt:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        /* EMPTY STATE */
        .empty-state {
            grid-column: 1 / -1;
            background: white;
            border-radius: var(--radius-xl);
            padding: 4rem 2rem;
            text-align: center;
            border: 2px dashed var(--border-color);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--border-color);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            background: var(--primary);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
        }

        /* LOADING SKELETON */
        .skeleton-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 1.25rem;
        }

        .skeleton-card {
            background: white;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            padding: 1.25rem;
            animation: pulse 1.5s infinite;
        }

        .skeleton-line {
            height: 1rem;
            background: #e5e7eb;
            border-radius: 50px;
            margin-bottom: 0.75rem;
        }

        .skeleton-line.short {
            width: 60%;
        }

        .skeleton-line.medium {
            width: 80%;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        /* SCROLLBAR */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
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

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .search-section {
                justify-content: stretch;
            }
            
            .search-box {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .held-main {
                padding: 1rem;
            }
            
            .held-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .held-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>

    <!-- LAYOUT MENTOK KE ATAS -->
    <div class="held-container">
        <div class="held-main custom-scrollbar">
            <!-- HEADER -->
            <div class="held-header">
                <div class="held-title-section">
                    <div class="held-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="held-title">
                        Held Orders
                        <span id="totalBadge">0</span>
                    </div>
                </div>
                <!-- BACK BUTTON -->
                <a href="/pos" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Kasir
                </a>
            </div>

            <!-- STATS CARDS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Held</h4>
                        <div class="stat-value" id="statTotal">0</div>
                        <span class="stat-label">orders</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Value</h4>
                        <div class="stat-value" id="statValue">Rp 0</div>
                        <span class="stat-label">all orders</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Items</h4>
                        <div class="stat-value" id="statItems">0</div>
                        <span class="stat-label">products</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Today</h4>
                        <div class="stat-value" id="statToday">0</div>
                        <span class="stat-label">new orders</span>
                    </div>
                </div>
            </div>

            <!-- SEARCH SECTION - NO FILTER TABS, ONLY SEARCH -->
            <div class="search-section">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchHeld" placeholder="Cari invoice atau produk...">
                </div>
            </div>

            <!-- HELD ORDERS GRID -->
            <div id="heldContainer">
                <!-- Loading skeleton -->
                <div class="skeleton-grid">
                    <div class="skeleton-card">
                        <div class="skeleton-line short"></div>
                        <div class="skeleton-line" style="width: 40%;"></div>
                        <div class="skeleton-line medium" style="margin-top: 1rem;"></div>
                        <div class="skeleton-line"></div>
                        <div class="skeleton-line short" style="margin-top: 1rem;"></div>
                    </div>
                    <div class="skeleton-card">
                        <div class="skeleton-line short"></div>
                        <div class="skeleton-line" style="width: 40%;"></div>
                        <div class="skeleton-line medium" style="margin-top: 1rem;"></div>
                        <div class="skeleton-line"></div>
                        <div class="skeleton-line short" style="margin-top: 1rem;"></div>
                    </div>
                    <div class="skeleton-card">
                        <div class="skeleton-line short"></div>
                        <div class="skeleton-line" style="width: 40%;"></div>
                        <div class="skeleton-line medium" style="margin-top: 1rem;"></div>
                        <div class="skeleton-line"></div>
                        <div class="skeleton-line short" style="margin-top: 1rem;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        let heldOrders = [];
        let searchQuery = '';

        // FORMAT CURRENCY
        function formatCurrency(value) {
            const formatter = new Intl.NumberFormat('id-ID', { 
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            return 'Rp ' + formatter.format(Math.round(value));
        }

        // FORMAT DATE
        function formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffTime = Math.abs(now - date);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays === 0) {
                return 'Hari ini, ' + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            } else if (diffDays === 1) {
                return 'Kemarin, ' + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            } else {
                return date.toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'short', 
                    year: 'numeric',
                    hour: '2-digit', 
                    minute: '2-digit' 
                });
            }
        }

        // FILTER ORDERS - ONLY SEARCH, NO DATE FILTER
        function filterOrders() {
            if (searchQuery === '') {
                return heldOrders;
            }
            
            return heldOrders.filter(order => {
                return order.invoice.toLowerCase().includes(searchQuery.toLowerCase()) ||
                    (order.items || []).some(item => 
                        item.name.toLowerCase().includes(searchQuery.toLowerCase())
                    );
            });
        }

        // UPDATE STATS
        function updateStats(orders) {
            const totalOrders = orders.length;
            const totalValue = orders.reduce((sum, order) => sum + (parseInt(order.total) || 0), 0);
            const totalItems = orders.reduce((sum, order) => {
                const items = order.items || [];
                return sum + items.reduce((itemSum, item) => itemSum + (item.qty || 0), 0);
            }, 0);
            const todayOrders = orders.filter(order => {
                const orderDate = new Date(order.created_at);
                const today = new Date();
                return orderDate.getDate() === today.getDate() &&
                    orderDate.getMonth() === today.getMonth() &&
                    orderDate.getFullYear() === today.getFullYear();
            }).length;

            document.getElementById('statTotal').textContent = totalOrders;
            document.getElementById('statValue').textContent = formatCurrency(totalValue);
            document.getElementById('statItems').textContent = totalItems;
            document.getElementById('statToday').textContent = todayOrders;
            document.getElementById('totalBadge').textContent = totalOrders;
        }

        // RENDER HELD ORDERS
        function renderHeldOrders(orders) {
            const container = document.getElementById('heldContainer');
            
            if (!orders || orders.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-clock"></i>
                        <h3>Tidak ada held orders</h3>
                        <p>Order yang di-hold akan muncul di sini</p>
                        <a href="/pos" class="btn-primary">
                            <i class="fas fa-shopping-cart"></i>
                            Mulai Transaksi
                        </a>
                    </div>
                `;
                return;
            }

            let html = '<div class="held-grid">';
            
            orders.forEach(sale => {
                const items = sale.items || [];
                const displayItems = items.slice(0, 2);
                const remainingItems = items.length - 2;
                
                html += `
                    <div class="held-card">
                        <div class="held-card-header">
                            <div class="invoice-badge">
                                <div class="invoice-number">
                                    <i class="fas fa-receipt"></i>
                                    ${sale.invoice}
                                </div>
                                <div class="invoice-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    ${formatDate(sale.created_at)}
                                </div>
                            </div>
                            <div class="status-badge">
                                <i class="fas fa-pause-circle"></i>
                                On Hold
                            </div>
                        </div>
                        
                        <div class="held-card-body">
                            <div class="items-preview">
                `;
                
                displayItems.forEach(item => {
                    html += `
                        <div class="preview-item">
                            <span class="preview-item-name">
                                <span class="item-qty-badge">${item.qty}x</span>
                                <span style="font-weight: 500;">${item.name}</span>
                            </span>
                            <span class="item-price">${formatCurrency(item.price * item.qty)}</span>
                        </div>
                    `;
                });
                
                if (remainingItems > 0) {
                    html += `
                        <div class="more-items">
                            <i class="fas fa-plus-circle"></i>
                            +${remainingItems} item lainnya
                        </div>
                    `;
                }
                
                html += `
                            </div>
                            
                            <div class="total-section">
                                <span class="total-label">
                                    <i class="fas fa-tag"></i>
                                    Total
                                </span>
                                <span class="total-value">${formatCurrency(sale.total)}</span>
                            </div>
                        </div>
                        
                        <div class="held-card-footer">
                            <div class="action-buttons">
                                <button onclick="resumeHeld(${sale.id})" class="btn btn-resume">
                                    <i class="fas fa-play-circle"></i>
                                    Resume
                                </button>
                                <a href="/pos/${sale.id}/receipt" class="btn btn-receipt">
                                    <i class="fas fa-file-invoice"></i>
                                    Receipt
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
            container.innerHTML = html;
        }

        // LOAD HELD ORDERS
        function loadHeld() {
            fetch('{{ route('pos.held') }}')
                .then(r => r.json())
                .then(data => {
                    heldOrders = data || [];
                    const filteredOrders = filterOrders();
                    updateStats(heldOrders);
                    renderHeldOrders(filteredOrders);
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('heldContainer').innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i>
                            <h3>Gagal memuat data</h3>
                            <p>Silakan coba lagi</p>
                            <button onclick="loadHeld()" class="btn-primary">
                                <i class="fas fa-sync-alt"></i>
                                Muat Ulang
                            </button>
                        </div>
                    `;
                });
        }

        // RESUME HELD ORDER
        function resumeHeld(id) {
            if (!confirm('Ambil order ini ke keranjang?')) return;
            
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/pos/${id}/resume`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': token 
                }
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        localStorage.setItem('pos_items', JSON.stringify(data.items));
                        window.location.href = '/pos';
                    } else {
                        alert('Gagal: ' + data.message);
                    }
                })
                .catch(err => {
                    alert('Gagal memproses resume');
                    console.error(err);
                });
        }

        // EVENT LISTENERS
        document.addEventListener('DOMContentLoaded', function() {
            loadHeld();
            
            // Search only - no filter tabs
            const searchInput = document.getElementById('searchHeld');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    searchQuery = e.target.value;
                    const filteredOrders = filterOrders();
                    renderHeldOrders(filteredOrders);
                });
            }
        });
    </script>
</x-app-layout>