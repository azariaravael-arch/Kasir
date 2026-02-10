<x-app-layout>
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="mb-0">
                    <i class="fas fa-user me-2"></i>{{ $customer->name }}
                </h2>
                <small class="text-muted">Detail informasi customer</small>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light border-bottom">
                        <h6 class="mb-0">Informasi Pribadi</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Nama</h6>
                                <h5>{{ $customer->name }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Status</h6>
                                <h5>
                                    @if($customer->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Email</h6>
                                <p>
                                    {{ $customer->email ?? '-' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">No. Telepon</h6>
                                <p>
                                    {{ $customer->phone ?? '-' }}
                                </p>
                            </div>
                        </div>

                        @if($customer->address)
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Alamat</h6>
                                <p>{{ $customer->address }}</p>
                            </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Kota</h6>
                                <p>{{ $customer->city ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Kode Pos</h6>
                                <p>{{ $customer->postal_code ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Tanggal Dibuat</h6>
                                <p>{{ $customer->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Terakhir Diubah</h6>
                                <p>{{ $customer->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Sales History -->
        @if($customer->sales()->count() > 0)
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5 class="mb-3">
                        <i class="fas fa-history me-2"></i>Riwayat Penjualan
                    </h5>
                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
                                        <th class="text-end">Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer->sales as $sale)
                                        <tr>
                                            <td>
                                                <a href="{{ route('pos.show', $sale) }}" class="text-primary">
                                                    {{ $sale->invoice_number ?? 'N/A' }}
                                                </a>
                                            </td>
                                            <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-end">
                                                Rp {{ number_format($sale->total, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Selesai</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Customer belum memiliki riwayat penjualan
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
