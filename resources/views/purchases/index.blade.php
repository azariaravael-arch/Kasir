<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        * {
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

        /* LAYOUT MENTOK KE ATAS - SAMA DENGAN POS */
        .purchase-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 64px);
            overflow: hidden;
            padding: 0;
            background: var(--gray-bg);
        }

        .purchase-main {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 2rem;
        }

        /* HEADER - TANPA TULISAN KASIR */
        .purchase-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
            flex-shrink: 0;
        }

        .purchase-title-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .purchase-icon {
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

        .purchase-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.01em;
        }

        .purchase-title span {
            color: var(--primary);
            background: var(--primary-light);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 0.75rem;
        }

        /* BUTTON TAMBAH - SAMA DENGAN BUTTON POS */
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

        /* SEARCH SECTION - ONLY SEARCH, NO FILTERS */
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

        /* CARD TABLE */
        .card-table {
            background: white;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        /* TABLE STYLING - MODERN & CLEAN */
        .table-purchases {
            width: 100%;
            border-collapse: collapse;
        }

        .table-purchases thead {
            background: #f8fafc;
            border-bottom: 1.5px solid var(--border-color);
        }

        .table-purchases th {
            padding: 1rem 1.25rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            text-align: left;
        }

        .table-purchases td {
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            color: var(--text-dark);
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-purchases tbody tr {
            transition: all 0.2s;
        }

        .table-purchases tbody tr:hover {
            background: var(--primary-light);
        }

        /* INVOICE LINK */
        .invoice-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .invoice-link i {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .invoice-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* STATUS BADGES */
        .badge-status {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            gap: 0.25rem;
        }

        .badge-draft {
            background: #f3f4f6;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
        }

        .badge-pending {
            background: #fffbeb;
            color: #f59e0b;
            border: 1px solid #fcd34d;
        }

        .badge-received {
            background: #ecfdf5;
            color: #10b981;
            border: 1px solid #a7f3d0;
        }

        .badge-cancelled {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        /* BUTTON ACTION */
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            color: var(--text-muted);
            background: white;
            border: 1.5px solid var(--border-color);
            transition: all 0.2s;
            text-decoration: none;
            margin-right: 0.25rem;
        }

        .btn-action:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn-action i {
            font-size: 0.8rem;
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
            padding: 0.6rem 1.5rem;
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

        /* ALERTS */
        .alert-custom {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid transparent;
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

        .alert-close {
            background: transparent;
            border: none;
            color: currentColor;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* PAGINATION */
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
            min-width: 36px;
            height: 36px;
            padding: 0 0.5rem;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border-color);
            color: var(--text-dark);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-item:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .pagination-item.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* LOADING SKELETON */
        .skeleton-row {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            animation: pulse 1.5s infinite;
        }

        .skeleton-line {
            height: 1rem;
            background: #e5e7eb;
            border-radius: 50px;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
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
            .purchase-main {
                padding: 1rem;
            }
            
            .purchase-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .search-section {
                justify-content: stretch;
            }
            
            .search-box {
                width: 100%;
            }
            
            .table-purchases th,
            .table-purchases td {
                padding: 0.75rem;
            }
        }
    </style>

    <!-- LAYOUT MENTOK KE ATAS -->
    <div class="purchase-container">
        <div class="purchase-main custom-scrollbar">
            <!-- HEADER - TANPA TULISAN KASIR -->
            <div class="purchase-header">
                <div class="purchase-title-section">
                    <div class="purchase-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="purchase-title">
                        Daftar Pembelian
                        <span id="totalBadge">{{ $purchases->total() }}</span>
                    </div>
                </div>
                <!-- BUTTON TAMBAH PEMBELIAN -->
                <a href="{{ route('purchases.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Pembelian Baru
                </a>
            </div>

            <!-- ALERTS - SIMPLIFIED -->
            @if($errors->any())
            <div class="alert-custom alert-danger">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>Error:</strong> {{ $errors->first() }}
                </div>
                <button type="button" class="alert-close" data-bs-dismiss="alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert-custom alert-success">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="alert-close" data-bs-dismiss="alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert-custom alert-danger">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
                <button type="button" class="alert-close" data-bs-dismiss="alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            <!-- SEARCH SECTION - ONLY SEARCH, NO FILTERS -->
            <div class="search-section">
                <form method="GET" action="{{ route('purchases.index') }}" class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="Cari nomor pembelian atau supplier..." 
                           value="{{ request('search') }}" autocomplete="off">
                </form>
            </div>

            <!-- TABLE CARD -->
            <div class="card-table">
                <div class="table-responsive">
                    <table class="table-purchases">
                        <thead>
                            <tr>
                                <th>No. Pembelian</th>
                                <th>Supplier</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $purchase)
                            <tr>
                                <td>
                                    <a href="{{ route('purchases.show', $purchase) }}" class="invoice-link">
                                        <i class="fas fa-receipt"></i>
                                        {{ $purchase->purchase_number }}
                                    </a>
                                </td>
                                <td>
                                    <span style="font-weight: 500;">{{ $purchase->supplier->name }}</span>
                                </td>
                                <td>
                                    <span style="color: var(--text-muted);">{{ $purchase->user->name }}</span>
                                </td>
                                <td>
                                    <span style="font-weight: 700; color: var(--primary-dark);">
                                        Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @switch($purchase->status)
                                        @case('draft')
                                            <span class="badge-status badge-draft">
                                                <i class="fas fa-pencil-alt"></i> Draft
                                            </span>
                                            @break
                                        @case('pending')
                                            <span class="badge-status badge-pending">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                            @break
                                        @case('received')
                                            <span class="badge-status badge-received">
                                                <i class="fas fa-check-circle"></i> Diterima
                                            </span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge-status badge-cancelled">
                                                <i class="fas fa-times-circle"></i> Dibatalkan
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <span style="color: var(--text-muted); font-size: 0.85rem;">
                                        <i class="fas fa-calendar-alt" style="margin-right: 0.25rem;"></i>
                                        {{ $purchase->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('purchases.show', $purchase) }}" class="btn-action" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($purchase->status === 'draft')
                                        <a href="{{ route('purchases.edit', $purchase) }}" class="btn-action" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-shopping-cart"></i>
                                    <h3>Belum ada data pembelian</h3>
                                    <p>Mulai dengan membuat pembelian baru</p>
                                    <a href="{{ route('purchases.create') }}" class="btn-empty">
                                        <i class="fas fa-plus"></i>
                                        Pembelian Baru
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PAGINATION -->
            @if($purchases->hasPages())
            <div class="pagination-custom">
                @if($purchases->onFirstPage())
                    <span class="pagination-item disabled" style="opacity: 0.5;">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $purchases->previousPageUrl() }}" class="pagination-item">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                @foreach($purchases->getUrlRange(1, $purchases->lastPage()) as $page => $url)
                    @if($page == $purchases->currentPage())
                        <span class="pagination-item active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                    @endif
                @endforeach

                @if($purchases->hasMorePages())
                    <a href="{{ $purchases->nextPageUrl() }}" class="pagination-item">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="pagination-item disabled" style="opacity: 0.5;">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </div>
            @endif
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-app-layout>