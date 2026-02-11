<x-app-layout>
    <div class="container-fluid py-3 sm:py-4 px-2 sm:px-4">
    <!-- Header -->
    <div class="row mb-3 sm:mb-4">
        <div class="col-12 sm:col-8">
            <h2 class="mb-0 text-lg sm:text-2xl font-black">Daftar Pembelian</h2>
        </div>
        <div class="col-12 sm:col-4 mt-3 sm:mt-0 text-end">
            <a href="{{ route('purchases.create') }}" class="btn btn-primary w-full sm:w-auto">
                <i class="fas fa-plus"></i> <span class="hidden sm:inline">Pembelian Baru</span><span class="inline sm:hidden">Baru</span>
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card mb-3 sm:mb-4">
        <div class="card-body p-2 sm:p-3">
            <form method="GET" action="{{ route('purchases.index') }}" class="row g-2 sm:g-3">
                <div class="col-12 sm:col-6 md:col-3">
                    <input type="text" name="search" class="form-control form-control-sm text-sm" 
                           placeholder="Cari nomor/supplier..." value="{{ request('search') }}">
                </div>
                <div class="col-6 sm:col-6 md:col-2">
                    <select name="status" class="form-select form-select-sm text-sm">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="received" {{ request('status') === 'received' ? 'selected' : '' }}>Diterima</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-6 sm:col-6 md:col-2">
                    <input type="date" name="from_date" class="form-control form-control-sm text-sm" 
                           value="{{ request('from_date') }}">
                </div>
                <div class="col-12 sm:col-6 md:col-2">
                    <input type="date" name="to_date" class="form-control form-control-sm text-sm" 
                           value="{{ request('to_date') }}">
                </div>
                <div class="col-12 sm:col-6 md:col-3">
                    <button type="submit" class="btn btn-sm btn-info w-full sm:w-auto">
                        <i class="fas fa-search"></i> <span class="hidden sm:inline">Cari</span>
                    </button>
                    <a href="{{ route('purchases.index') }}" class="btn btn-sm btn-secondary w-full sm:w-auto mt-2 sm:mt-0">
                        <i class="fas fa-redo"></i> <span class="hidden sm:inline">Reset</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Alerts -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

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

    <!-- Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Pembelian</th>
                        <th>Supplier</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                    <tr>
                        <td>
                            <a href="{{ route('purchases.show', $purchase) }}" class="text-decoration-none">
                                <strong>{{ $purchase->purchase_number }}</strong>
                            </a>
                        </td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->user->name }}</td>
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
                            @if($purchase->status === 'draft')
                                <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-inbox text-muted"></i>
                            <p class="text-muted mt-2">Belum ada data pembelian</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $purchases->links() }}
    </div>
    </div>

    @push('styles')
    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    @endpush
</x-app-layout>
