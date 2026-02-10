<x-app-layout>
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                
                <small class="text-muted"></small>
            </div>
            <div class="col-md-4 text-end">
               
            </div>
        </div>

        <!-- Master Data Management Grid -->
        <div class="row">
            <!-- Supplier Management -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s; cursor: pointer;">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-building" style="font-size: 3.5rem; color: #0D8ABC;"></i>
                        </div>
                        <h5 class="card-title mb-2">Data Supplier</h5>
                        <p class="text-muted small mb-3">Kelola informasi supplier</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                <i class="fas fa-list me-1"></i>Lihat
                            </a>
                            <a href="{{ route('suppliers.create') }}" class="btn btn-sm btn-primary flex-grow-1">
                                <i class="fas fa-plus me-1"></i>Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center border-top-0">
                        <small class="text-muted">
                            <i class="fas fa-database me-1"></i>
                            Total: <strong>{{ $totalSuppliers }}</strong>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Product Management -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s; cursor: pointer;">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-box" style="font-size: 3.5rem; color: #20a770;"></i>
                        </div>
                        <h5 class="card-title mb-2">Data Barang</h5>
                        <p class="text-muted small mb-3">Kelola produk dan stok</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-success flex-grow-1">
                                <i class="fas fa-list me-1"></i>Lihat
                            </a>
                            <a href="{{ route('products.create') }}" class="btn btn-sm btn-success flex-grow-1">
                                <i class="fas fa-plus me-1"></i>Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center border-top-0">
                        <small class="text-muted">
                            <i class="fas fa-database me-1"></i>
                            Total: <strong>{{ $totalProducts }}</strong>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Category Management -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s; cursor: pointer;">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-tags" style="font-size: 3.5rem; color: #FF9800;"></i>
                        </div>
                        <h5 class="card-title mb-2">Kategori Barang</h5>
                        <p class="text-muted small mb-3">Kelola kategori produk</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-warning flex-grow-1">
                                <i class="fas fa-list me-1"></i>Lihat
                            </a>
                            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-warning flex-grow-1">
                                <i class="fas fa-plus me-1"></i>Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center border-top-0">
                        <small class="text-muted">
                            <i class="fas fa-database me-1"></i>
                            Total: <strong>{{ $totalCategories }}</strong>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Customer Management -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s; cursor: pointer;">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-users" style="font-size: 3.5rem; color: #9C27B0;"></i>
                        </div>
                        <h5 class="card-title mb-2">Data Customer</h5>
                        <p class="text-muted small mb-3">Kelola data pelanggan</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('customers.index') }}" class="btn btn-sm btn-outline-secondary flex-grow-1">
                                <i class="fas fa-list me-1"></i>Lihat
                            </a>
                            <a href="{{ route('customers.create') }}" class="btn btn-sm btn-secondary flex-grow-1">
                                <i class="fas fa-plus me-1"></i>Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center border-top-0">
                        <small class="text-muted">
                            <i class="fas fa-database me-1"></i>
                            Total: <strong>{{ $totalCustomers }}</strong>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Master Data Section -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <h5 class="mb-3">
                    <i class="fas fa-history me-2"></i>Master Data Transaksi & Monitoring
                </h5>
            </div>

            <!-- Purchases -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s;">
                    <div class="card-body text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-dolly" style="font-size: 3rem; color: #2196F3;"></i>
                        </div>
                        <h6 class="card-title mb-2">Pembelian</h6>
                        <p class="text-muted small mb-3">Kelola pembelian barang</p>
                        <a href="{{ route('purchases.index') }}" class="btn btn-sm btn-outline-info w-100">
                            <i class="fas fa-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                    <div class="card-footer bg-light text-center">
                        <small class="text-muted">Total: <strong>{{ $totalPurchases }}</strong></small>
                    </div>
                </div>
            </div>

            <!-- Returns -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s;">
                    <div class="card-body text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-undo-alt" style="font-size: 3rem; color: #FF9800;"></i>
                        </div>
                        <h6 class="card-title mb-2">Retur</h6>
                        <p class="text-muted small mb-3">Kelola retur barang</p>
                        <a href="{{ route('returns.index') }}" class="btn btn-sm btn-outline-warning w-100">
                            <i class="fas fa-arrow-right me-1"></i>Kelola
                        </a>
                    </div>
                    <div class="card-footer bg-light text-center">
                        <small class="text-muted">Total: <strong>{{ $totalReturns }}</strong></small>
                    </div>
                </div>
            </div>

            <!-- Stock Alert -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm {{ $lowStockProducts->count() > 0 ? 'border-danger' : '' }}" style="transition: all 0.3s;">
                    <div class="card-body text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #F44336;"></i>
                        </div>
                        <h6 class="card-title mb-2">Stok Rendah</h6>
                        <p class="text-muted small mb-3">Barang dengan stok kurang</p>
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-danger w-100">
                            <i class="fas fa-arrow-right me-1"></i>Lihat
                        </a>
                    </div>
                    <div class="card-footer bg-light text-center">
                        <small class="text-muted">
                            {{ $lowStockProducts->count() }} item
                            @if($lowStockProducts->count() > 0)
                                <span class="badge bg-danger ms-1">!</span>
                            @endif
                        </small>
                    </div>
                </div>
            </div>

            <!-- Nilai Stok -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s;">
                    <div class="card-body text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-chart-pie" style="font-size: 3rem; color: #673AB7;"></i>
                        </div>
                        <h6 class="card-title mb-2">Nilai Stok</h6>
                        <p class="text-muted small mb-3">Total nilai stok produk</p>
                        <div class="h6 mb-0" style="color: #673AB7;">
                            Rp {{ number_format($totalStockValue ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert Section -->
        @if($lowStockProducts->count() > 0)
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>
                            <i class="fas fa-exclamation-circle me-2"></i>Peringatan Stok Rendah
                        </strong>
                        <p class="mb-2">Produk berikut memiliki stok yang rendah atau habis:</p>
                        <ul class="mb-0">
                            @foreach($lowStockProducts as $product)
                                <li>
                                    <strong>{{ $product->name }}</strong> 
                                    (SKU: {{ $product->sku }}) - 
                                    <span class="badge bg-danger">Stok: {{ $product->stock }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15) !important;
        }
    </style>
</x-app-layout>
