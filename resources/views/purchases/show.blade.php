<x-app-layout>
    <div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Detail Pembelian {{ $purchase->purchase_number }}</h2>
        </div>
        <div class="col-md-4 text-end">
            @if($purchase->status === 'draft')
                <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            @elseif($purchase->status === 'pending')
                <form method="POST" action="{{ route('purchases.receive', $purchase) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success" onclick="return confirm('Terima pembelian dan perbarui stok?')">
                        <i class="fas fa-check"></i> Terima Pembelian
                    </button>
                </form>
            @endif
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Header Info Card -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">No. Pembelian</label>
                                <h5>{{ $purchase->purchase_number }}</h5>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Supplier</label>
                                <h5>{{ $purchase->supplier->name }}</h5>
                                <small class="text-muted">
                                    @if($purchase->supplier->phone)
                                    {{ $purchase->supplier->phone }}<br>
                                    @endif
                                    @if($purchase->supplier->email)
                                    {{ $purchase->supplier->email }}
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Status</label>
                                <div>
                                    @switch($purchase->status)
                                        @case('draft')
                                            <span class="badge bg-secondary fs-6">Draft</span>
                                            @break
                                        @case('pending')
                                            <span class="badge bg-warning fs-6">Pending</span>
                                            @break
                                        @case('received')
                                            <span class="badge bg-success fs-6">Diterima</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger fs-6">Dibatalkan</span>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">User</label>
                                <h5>{{ $purchase->user->name }}</h5>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Tanggal Pembelian</label>
                                <h5>{{ $purchase->created_at->format('d/m/Y H:i') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Detail Barang</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th>SKU</th>
                                <th class="text-end">Qty</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td><small class="text-muted">{{ $item->product->sku }}</small></td>
                                <td class="text-end">{{ $item->quantity }}</td>
                                <td class="text-end">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                <td class="text-end fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Notes Card -->
            @if($purchase->notes)
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Catatan</h5>
                </div>
                <div class="card-body">
                    {{ $purchase->notes }}
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Summary Card -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">Jumlah Item:</div>
                        <div class="col-6 text-end"><strong>{{ $purchase->items->count() }}</strong></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">Total Qty:</div>
                        <div class="col-6 text-end"><strong>{{ $purchase->items->sum('quantity') }}</strong></div>
                    </div>
                    <div class="row border-top pt-2">
                        <div class="col-6">Total Pembelian:</div>
                        <div class="col-6 text-end">
                            <h5 class="mb-0">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Card -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    @if($purchase->status === 'draft')
                        <div class="d-grid gap-2">
                            <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('purchases.destroy', $purchase) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100" 
                                        onclick="return confirm('Hapus pembelian ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    @elseif($purchase->status === 'pending')
                        <div class="d-grid gap-2">
                            <form method="POST" action="{{ route('purchases.receive', $purchase) }}">
                                @csrf
                                <button type="submit" class="btn btn-success" 
                                        onclick="return confirm('Terima pembelian dan perbarui stok?')">
                                    <i class="fas fa-check"></i> Terima
                                </button>
                            </form>
                            <form method="POST" action="{{ route('purchases.cancel', $purchase) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-secondary w-100" 
                                        onclick="return confirm('Batalkan pembelian ini?')">
                                    <i class="fas fa-times"></i> Batalkan
                                </button>
                            </form>
                        </div>
                    @elseif($purchase->status === 'received')
                        <div class="alert alert-success mb-0">
                            <i class="fas fa-check-circle"></i> Pembelian telah diterima
                            <br>
                            <small>{{ $purchase->received_date?->format('d/m/Y H:i') }}</small>
                        </div>
                    @else
                        <div class="alert alert-danger mb-0">
                            <i class="fas fa-ban"></i> Pembelian telah dibatalkan
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
