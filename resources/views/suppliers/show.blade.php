<x-app-layout>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h2>Detail Supplier</h2>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
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
                <!-- Supplier Info Card -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Informasi Supplier</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Nama Supplier</label>
                                <h5>{{ $supplier->name }}</h5>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Status</label>
                                <div>
                                    @if($supplier->is_active)
                                        <span class="badge bg-success fs-6">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary fs-6">Tidak Aktif</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Nama Kontak</label>
                                <p>{{ $supplier->contact_person ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Telepon</label>
                                <p>{{ $supplier->phone ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Email</label>
                                <p>
                                    @if($supplier->email)
                                        <a href="mailto:{{ $supplier->email }}">{{ $supplier->email }}</a>
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Kota</label>
                                <p>{{ $supplier->city ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-muted small">Alamat</label>
                                <p>{{ $supplier->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purchase History -->
                @if($supplier->purchases->count() > 0)
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Riwayat Pembelian</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No. Pembelian</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier->purchases as $purchase)
                                <tr>
                                    <td>
                                        <a href="{{ route('purchases.show', $purchase) }}" class="text-decoration-none">
                                            <strong>{{ $purchase->purchase_number }}</strong>
                                        </a>
                                    </td>
                                    <td>Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @switch($purchase->status)
                                            @case('draft')
                                                <span class="badge bg-secondary">Draft</span>
                                                @break
                                            @case('pending')
                                                <span class="badge bg-warning">Pending</span>
                                                @break
                                            @case('received')
                                                <span class="badge bg-success">Diterima</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger">Dibatalkan</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Info Card -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Informasi Tambahan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">Jumlah Pembelian:</div>
                            <div class="col-6 text-end"><strong>{{ $supplier->purchases->count() }}</strong></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Total Pembelian:</div>
                            <div class="col-6 text-end">
                                <strong>Rp {{ number_format($supplier->purchases->sum('total_amount'), 0, ',', '.') }}</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">Bergabung Sejak:</div>
                            <div class="col-6 text-end"><small>{{ $supplier->created_at->format('d/m/Y') }}</small></div>
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Aksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100" 
                                        onclick="return confirm('Hapus supplier ini? Pastikan tidak ada riwayat pembelian.')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
