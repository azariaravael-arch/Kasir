<x-app-layout>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="mb-0">
                    <i class="fas fa-undo-alt me-2"></i>Detail Retur
                </h2>
                <small class="text-muted">{{ $return->return_number }}</small>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('returns.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Return Info Card -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Retur
                                </h6>
                            </div>
                            <div class="col-auto">
                                @switch($return->status)
                                    @case('draft')
                                        <span class="badge bg-secondary">Draft</span>
                                        @break
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                        @break
                                    @case('approved')
                                        <span class="badge bg-success">Disetujui</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>No Retur:</strong><br>
                                {{ $return->return_number }}
                            </div>
                            <div class="col-md-6">
                                <strong>Tanggal Retur:</strong><br>
                                @if($return->return_date)
                                    {{ $return->return_date->format('d/m/Y H:i') }}
                                @else
                                    <span class="text-muted">Belum disetujui</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>No Pembelian:</strong><br>
                                <a href="{{ route('purchases.show', $return->purchase) }}">
                                    {{ $return->purchase->purchase_number }}
                                </a>
                            </div>
                            <div class="col-md-6">
                                <strong>Supplier:</strong><br>
                                <a href="{{ route('suppliers.show', $return->supplier) }}">
                                    {{ $return->supplier->name }}
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Dibuat oleh:</strong><br>
                                {{ $return->user->name }} ({{ $return->created_at->format('d/m/Y H:i') }})
                            </div>
                            <div class="col-md-6">
                                <strong>Alasan Retur:</strong><br>
                                {{ $return->reason ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Return Items -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="fas fa-list me-2"></i>Item Retur
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Harga Satuan</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($return->items as $item)
                                    <tr>
                                        <td>
                                            <strong>{{ $item->product->name }}</strong><br>
                                            <small class="text-muted">{{ $item->product->category ?? '-' }}</small>
                                        </td>
                                        <td class="text-center">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="text-end">
                                            Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end">
                                            <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <small class="text-muted"><strong>Alasan:</strong> {{ $item->reason }}</small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Notes -->
                @if($return->notes)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-note-sticky me-2"></i>Catatan
                            </h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $return->notes }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Summary -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-calculator me-2"></i>Ringkasan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Item:</span>
                            <strong>{{ $return->items->count() }} item</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total Quantity:</span>
                            <strong>{{ $return->items->sum('quantity') }} unit</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="h6">Total Nilai:</span>
                            <strong class="h6">Rp {{ number_format($return->total_amount, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="fas fa-cog me-2"></i>Aksi
                        </h6>
                    </div>
                    <div class="card-body d-grid gap-2">
                        @if($return->status === 'draft')
                            <a href="{{ route('returns.edit', $return) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>

                            <form action="{{ route('returns.approve', $return) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success w-100" 
                                        onclick="return confirm('Setujui retur dan kurangi stok?')">
                                    <i class="fas fa-check me-1"></i>Setujui
                                </button>
                            </form>

                            <form action="{{ route('returns.reject', $return) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100" 
                                        onclick="return confirm('Tolak retur?')">
                                    <i class="fas fa-times me-1"></i>Tolak
                                </button>
                            </form>

                            <form action="{{ route('returns.destroy', $return) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100" 
                                        onclick="return confirm('Hapus retur?')">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </form>
                        @elseif($return->status === 'rejected')
                            <form action="{{ route('returns.destroy', $return) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100" 
                                        onclick="return confirm('Hapus retur?')">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </form>
                        @else
                            <div class="text-muted text-center py-3">
                                <i class="fas fa-lock me-1"></i>Retur sudah diproses
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Purchase Info -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="fas fa-dolly me-2"></i>Info Pembelian
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>No Pembelian:</strong><br>
                            {{ $return->purchase->purchase_number }}
                        </div>
                        <div class="mb-2">
                            <strong>Total Pembelian:</strong><br>
                            Rp {{ number_format($return->purchase->total_amount, 0, ',', '.') }}
                        </div>
                        <div class="mb-2">
                            <strong>Status:</strong><br>
                            <span class="badge bg-success">{{ ucfirst($return->purchase->status) }}</span>
                        </div>
                        <a href="{{ route('purchases.show', $return->purchase) }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                            <i class="fas fa-eye me-1"></i>Lihat Detail Pembelian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
