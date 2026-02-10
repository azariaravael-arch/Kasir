<x-app-layout>
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="mb-0">
                    <i class="fas fa-tag me-2"></i>{{ $category->name }}
                </h2>
                <small class="text-muted">Detail kategori produk</small>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Nama Kategori</h6>
                                <h5>{{ $category->name }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Jumlah Produk</h6>
                                <h5>
                                    <span class="badge bg-info">{{ $category->products()->count() }}</span>
                                </h5>
                            </div>
                        </div>

                        @if($category->description)
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Deskripsi</h6>
                                <p>{{ $category->description }}</p>
                            </div>
                        @endif

                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Tanggal Dibuat</h6>
                            <p>{{ $category->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products in Category -->
        @if($category->products()->count() > 0)
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5 class="mb-3">
                        <i class="fas fa-box me-2"></i>Produk dalam Kategori ini
                    </h5>
                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>SKU</th>
                                        <th>Nama Produk</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->products as $product)
                                        <tr>
                                            <td>
                                                <code>{{ $product->sku }}</code>
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <span class="badge bg-{{ $product->stock > 5 ? 'success' : 'danger' }}">
                                                    {{ $product->stock }}
                                                </span>
                                            </td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
