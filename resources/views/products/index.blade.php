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
            --radius-2xl: 24px;
        }

        body {
            background: var(--gray-bg);
        }

        /* LAYOUT MENTOK KE ATAS - SAMA DENGAN POS */
        .product-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 64px);
            overflow: hidden;
            padding: 0;
            background: var(--gray-bg);
        }

        .product-main {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 2rem;
        }

        /* HEADER - SAMA DENGAN POS & HELD ORDERS */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
            flex-shrink: 0;
        }

        .header-title-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-icon {
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

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.01em;
        }

        .page-title span {
            color: var(--primary);
            background: var(--primary-light);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 0.75rem;
        }

        /* BUTTON TAMBAH - SAMA DENGAN POS */
        .btn-add {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: var(--primary);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .btn-add:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-add i {
            font-size: 0.9rem;
        }

        /* ALERTS - MODERN SEPERTI POS */
        .alert-custom {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-lg);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid transparent;
            box-shadow: var(--shadow-sm);
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-content i {
            font-size: 1.1rem;
        }

        .alert-close {
            background: transparent;
            border: none;
            color: currentColor;
            cursor: pointer;
            opacity: 0.7;
            transition: all 0.2s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
        }

        .alert-close:hover {
            opacity: 1;
            background: rgba(0, 0, 0, 0.05);
        }

        /* CARD TABLE - SAMA DENGAN POS */
        .card-table {
            background: white;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s;
        }

        .card-table:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-lg);
        }

        /* TABLE STYLING - MODERN & CLEAN */
        .table-products {
            width: 100%;
            border-collapse: collapse;
        }

        .table-products thead {
            background: #f8fafc;
            border-bottom: 1.5px solid var(--border-color);
        }

        .table-products th {
            padding: 1.25rem 1.25rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            text-align: left;
        }

        .table-products td {
            padding: 1.25rem 1.25rem;
            font-size: 0.9rem;
            color: var(--text-dark);
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-products tbody tr {
            transition: all 0.2s;
        }

        .table-products tbody tr:hover {
            background: var(--primary-light);
        }

        .table-products tbody tr:last-child td {
            border-bottom: none;
        }

        /* PRODUCT IMAGE */
        .product-image-wrapper {
            width: 50px;
            height: 50px;
            background: #f3f4f6;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .product-image-wrapper:hover {
            border-color: var(--primary);
        }

        .product-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image-placeholder {
            font-size: 1.5rem;
            opacity: 0.3;
        }

        /* PRODUCT NAME */
        .product-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .product-sku {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* CATEGORY BADGE */
        .category-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            border: 1px solid var(--primary-soft);
        }

        .category-badge i {
            font-size: 0.65rem;
            margin-right: 0.25rem;
            color: var(--primary);
        }

        /* PRICE */
        .product-price {
            font-size: 1rem;
            font-weight: 800;
            color: var(--primary-dark);
            background: var(--primary-light);
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            display: inline-block;
        }

        /* STOCK BADGE */
        .stock-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
            padding: 0.35rem 0.75rem;
            background: #f3f4f6;
            color: var(--text-dark);
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            border: 1px solid var(--border-color);
        }

        .stock-low {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fecaca;
        }

        /* ACTION BUTTONS */
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: var(--radius-md);
            color: var(--text-muted);
            background: white;
            border: 1.5px solid var(--border-color);
            transition: all 0.2s;
            text-decoration: none;
            margin: 0 0.2rem;
        }

        .btn-action:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn-action-danger:hover {
            border-color: #dc2626;
            color: #dc2626;
            background: #fee2e2;
        }

        /* MOBILE CARD - SEPERTI CARD PRODUK DI POS */
        .mobile-card {
            background: white;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .mobile-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .mobile-image {
            width: 70px;
            height: 70px;
            background: #f3f4f6;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-category {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            border: 1px solid var(--primary-soft);
        }

        .mobile-price {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .mobile-stock {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .btn-mobile-edit {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: var(--radius-lg);
            font-size: 0.8rem;
            font-weight: 700;
            border: 1.5px solid var(--primary-soft);
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-mobile-edit:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .btn-mobile-delete {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem;
            background: #fee2e2;
            color: #dc2626;
            border-radius: var(--radius-lg);
            font-size: 0.8rem;
            font-weight: 700;
            border: 1.5px solid #fecaca;
            transition: all 0.2s;
        }

        .btn-mobile-delete:hover {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
        }

        /* PAGINATION - SAMA DENGAN POS */
        .pagination-custom {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination-item {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 0.75rem;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--border-color);
            color: var(--text-dark);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            background: white;
        }

        .pagination-item:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .pagination-item.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-item.disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* MODAL - STYLING SESUAI POS */
        .modal-content-custom {
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
        }

        .modal-header-custom {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            border-bottom: 1.5px solid var(--border-color);
        }

        .modal-title-custom {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modal-title-custom i {
            color: var(--primary);
        }

        .modal-body-custom {
            padding: 1.5rem;
        }

        .modal-footer-custom {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            border-top: 1.5px solid var(--border-color);
        }

        .btn-modal-secondary {
            padding: 0.6rem 1.2rem;
            background: white;
            color: var(--text-dark);
            border: 1.5px solid var(--border-color);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .btn-modal-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .btn-modal-primary {
            padding: 0.6rem 1.2rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-modal-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        /* EMPTY STATE */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-state i {
            font-size: 3.5rem;
            color: var(--border-color);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .btn-empty {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.75rem;
            background: var(--primary);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-empty:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.2);
        }

        /* SCROLLBAR - SAMA DENGAN POS */
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
        @media (max-width: 768px) {
            .product-main {
                padding: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .btn-add {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <!-- LAYOUT MENTOK KE ATAS - SAMA DENGAN POS -->
    <div class="product-container">
        <div class="product-main custom-scrollbar">
            <!-- HEADER - SAMA DENGAN POS & HELD ORDERS -->
            <div class="page-header">
                <div class="header-title-section">
                    <div class="header-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="page-title">
                        Daftar Produk
                        <span>{{ $products->total() }} Item</span>
                    </div>
                </div>
                <a href="{{ route('products.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Tambah Produk
                </a>
            </div>

            <!-- ALERTS - MODERN SEPERTI POS -->
            @if(session('success'))
                <div class="alert-custom alert-success">
                    <div class="alert-content">
                        <i class="fas fa-check-circle"></i>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-custom alert-danger">
                    <div class="alert-content">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="font-bold">{{ session('error') }}</span>
                    </div>
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- DESKTOP TABLE VIEW -->
            <div class="hidden md:block card-table">
                <div class="overflow-x-auto">
                    <table class="table-products">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        <div class="product-image-wrapper">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                            @else
                                                <span class="product-image-placeholder">📦</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-name">
                                            {{ $product->name }}
                                        </div>
                                        <div class="product-sku">
                                            SKU: {{ $product->sku }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="category-badge">
                                            <i class="fas fa-tag"></i>
                                            {{ $product->categoryRelation?->name ?? 'Tanpa Kategori' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="product-price">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="stock-badge {{ $product->stock <= 5 ? 'stock-low' : '' }}">
                                            {{ $product->stock }} Unit
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex justify-center items-center gap-2">
                                            <a href="{{ route('products.edit', $product) }}" 
                                               class="btn-action" 
                                               title="Edit Produk">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn-action btn-action-danger" 
                                                        title="Hapus Produk">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-boxes"></i>
                                            <h3>Belum ada produk</h3>
                                            <p>Mulai dengan menambahkan produk baru</p>
                                            <a href="{{ route('products.create') }}" class="btn-empty">
                                                <i class="fas fa-plus"></i>
                                                Tambah Produk
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MOBILE CARD VIEW - SEPERTI POS -->
            <div class="md:hidden">
                @forelse($products as $product)
                    <div class="mobile-card">
                        <div class="flex gap-4 mb-4">
                            <div class="shrink-0">
                                <div class="mobile-image">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             class="w-full h-full object-cover" 
                                             alt="{{ $product->name }}">
                                    @else
                                        <span class="text-2xl opacity-30">📦</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1">
                                    <h3 class="font-800 text-gray-900 text-base truncate">{{ $product->name }}</h3>
                                </div>
                                <div class="text-xs text-gray-400 font-700 mb-2">
                                    SKU: {{ $product->sku }}
                                </div>
                                <div class="mobile-category">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $product->categoryRelation?->name ?? 'Tanpa Kategori' }}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4 pt-4 border-t border-gray-100">
                            <div>
                                <div class="text-xs text-gray-500 font-700 mb-1">Harga</div>
                                <div class="mobile-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 font-700 mb-1">Stok</div>
                                <div class="mobile-stock">
                                    {{ $product->stock }} Unit
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('products.edit', $product) }}" 
                               class="btn-mobile-edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" 
                                  method="POST" 
                                  class="flex-1"
                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-mobile-delete w-full">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-boxes"></i>
                        <h3>Belum ada produk</h3>
                        <p>Mulai dengan menambahkan produk baru</p>
                        <a href="{{ route('products.create') }}" class="btn-empty">
                            <i class="fas fa-plus"></i>
                            Tambah Produk
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- PAGINATION -->
            @if($products->hasPages())
                <div class="pagination-custom">
                    @if($products->onFirstPage())
                        <span class="pagination-item disabled">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="pagination-item">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if($page == $products->currentPage())
                            <span class="pagination-item active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="pagination-item">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="pagination-item disabled">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- ADD CATEGORY MODAL - STYLING POS -->
    <div class="modal fade" id="addCategoryModalIndex" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Kategori Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-custom">
                    <form id="addCategoryForm">
                        <div class="mb-4">
                            <label for="categoryName" class="form-label fw-700 text-muted">
                                <i class="fas fa-tag text-primary me-1"></i>
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="categoryName" name="name" 
                                   placeholder="Contoh: Makanan Berat" required
                                   style="border: 1.5px solid var(--border-color); border-radius: var(--radius-md); padding: 0.6rem 1rem;">
                        </div>
                        <div class="mb-3">
                            <label for="categoryDesc" class="form-label fw-700 text-muted">
                                <i class="fas fa-align-left text-primary me-1"></i>
                                Deskripsi
                            </label>
                            <textarea class="form-control" id="categoryDesc" name="description" 
                                      rows="3" placeholder="Opsional - Deskripsi kategori"
                                      style="border: 1.5px solid var(--border-color); border-radius: var(--radius-md); padding: 0.6rem 1rem;"></textarea>
                        </div>
                    </form>
                    <div id="categoryAlert"></div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>
                        Batal
                    </button>
                    <button type="button" class="btn-modal-primary" id="saveCategoryBtn">
                        <i class="fas fa-save"></i>
                        Simpan Kategori
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT CATEGORY MODAL - STYLING POS -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        <i class="fas fa-edit"></i>
                        Edit Kategori
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-custom">
                    <form id="editCategoryForm">
                        <input type="hidden" id="editCategoryId" name="id">
                        <div class="mb-4">
                            <label for="editCategoryName" class="form-label fw-700 text-muted">
                                <i class="fas fa-tag text-primary me-1"></i>
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="editCategoryName" name="name" required
                                   style="border: 1.5px solid var(--border-color); border-radius: var(--radius-md); padding: 0.6rem 1rem;">
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryDesc" class="form-label fw-700 text-muted">
                                <i class="fas fa-align-left text-primary me-1"></i>
                                Deskripsi
                            </label>
                            <textarea class="form-control" id="editCategoryDesc" name="description" 
                                      rows="3"
                                      style="border: 1.5px solid var(--border-color); border-radius: var(--radius-md); padding: 0.6rem 1rem;"></textarea>
                        </div>
                    </form>
                    <div id="editCategoryAlert"></div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>
                        Batal
                    </button>
                    <button type="button" class="btn-modal-primary" id="updateCategoryBtn">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add Category
            const saveCategoryBtn = document.getElementById('saveCategoryBtn');
            if (saveCategoryBtn) {
                saveCategoryBtn.addEventListener('click', function() {
                    const form = document.getElementById('addCategoryForm');
                    const name = document.getElementById('categoryName').value;
                    const description = document.getElementById('categoryDesc').value;
                    const alertDiv = document.getElementById('categoryAlert');

                    if (!name.trim()) {
                        alertDiv.innerHTML = '<div class="alert alert-warning" style="border-radius: var(--radius-md); padding: 0.75rem 1rem;">Nama kategori tidak boleh kosong</div>';
                        return;
                    }

                    fetch('{{ route("categories.store.api") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            name: name,
                            description: description
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            form.reset();
                            alertDiv.innerHTML = '<div class="alert alert-success" style="border-radius: var(--radius-md); padding: 0.75rem 1rem;">Kategori berhasil ditambahkan!</div>';
                            
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            alertDiv.innerHTML = '<div class="alert alert-danger" style="border-radius: var(--radius-md); padding: 0.75rem 1rem;">Gagal menambah kategori</div>';
                        }
                    })
                    .catch(error => {
                        alertDiv.innerHTML = '<div class="alert alert-danger" style="border-radius: var(--radius-md); padding: 0.75rem 1rem;">Error: ' + error + '</div>';
                    });
                });
            }

            // Edit Category
            window.editCategory = function(id, name, description) {
                document.getElementById('editCategoryId').value = id;
                document.getElementById('editCategoryName').value = name;
                document.getElementById('editCategoryDesc').value = description || '';
            };

            const updateCategoryBtn = document.getElementById('updateCategoryBtn');
            if (updateCategoryBtn) {
                updateCategoryBtn.addEventListener('click', function() {
                    const id = document.getElementById('editCategoryId').value;
                    const name = document.getElementById('editCategoryName').value;
                    const description = document.getElementById('editCategoryDesc').value;
                    const alertDiv = document.getElementById('editCategoryAlert');

                    if (!name.trim()) {
                        alertDiv.innerHTML = '<div class="alert alert-warning" style="border-radius: var(--radius-md); padding: 0.75rem 1rem;">Nama kategori tidak boleh kosong</div>';
                        return;
                    }

                    fetch(`/category/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            name: name,
                            description: description
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alertDiv.innerHTML = '<div class="alert alert-success" style="border-radius: var(--radius-md); padding: 0.75rem 1rem;">Kategori berhasil diperbarui!</div>';
                            
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            alertDiv.innerHTML = '<div class="alert alert-danger" style="border-radius: var(--radius-md); padding: 0.75rem 1rem;">Gagal memperbarui kategori</div>';
                        }
                    })
                    .catch(error => {
                        alertDiv.innerHTML = '<div class="alert alert-danger" style="border-radius: var(--radius-md); padding: 0.75rem 1rem;">Error: ' + error + '</div>';
                    });
                });
            }
        });
    </script>
</x-app-layout>