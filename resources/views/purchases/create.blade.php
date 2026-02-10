<x-app-layout>
    <div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Buat Pembelian Baru</h2>
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

    <form method="POST" action="{{ route('purchases.store') }}" id="purchaseForm">
        @csrf

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Supplier Card -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Informasi Supplier</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="supplier_id" class="form-label">Pilih Supplier <span class="text-danger">*</span></label>
                                <select name="supplier_id" id="supplier_id" class="form-select form-select-lg @error('supplier_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="supplier_contact" class="form-label">Kontak</label>
                                <input type="text" id="supplier_contact" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items Card -->
                <div class="card mb-3">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Barang</h5>
                        <button type="button" class="btn btn-sm btn-primary" id="addItemBtn">
                            <i class="fas fa-plus"></i> Tambah Barang
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="itemsContainer">
                            <!-- Items akan ditambahkan di sini -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Summary Card -->
                <div class="card mb-3 position-sticky" style="top: 20px;">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Ringkasan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm mb-0">
                            <tr>
                                <td>Jumlah Item:</td>
                                <td class="text-end"><strong id="totalItems">0</strong></td>
                            </tr>
                            <tr>
                                <td>Total Qty:</td>
                                <td class="text-end"><strong id="totalQty">0</strong></td>
                            </tr>
                            <tr class="border-top pt-2">
                                <td>Total Pembelian:</td>
                                <td class="text-end">
                                    <h5 class="mb-0">Rp <span id="totalAmount">0</span></h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Notes Card -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Catatan</h5>
                    </div>
                    <div class="card-body">
                        <textarea name="notes" class="form-control form-control-sm" rows="3" placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <!-- Status Card -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="statusDraft" value="draft" checked>
                            <label class="form-check-label" for="statusDraft">
                                Draft (Simpan untuk nanti)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="statusPending" value="pending">
                            <label class="form-check-label" for="statusPending">
                                Pending (Siap diterima)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-lg btn-success">
                        <i class="fas fa-save"></i> Simpan Pembelian
                    </button>
                    <a href="{{ route('purchases.index') }}" class="btn btn-lg btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Item Template -->
<template id="itemTemplate">
    <div class="purchase-item card mb-2">
        <div class="card-body p-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <label class="form-label">Produk</label>
                    <select name="items[INDEX][product_id]" class="form-select product-select" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} ({{ $product->sku }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Qty</label>
                    <input type="number" name="items[INDEX][quantity]" class="form-control qty-input" 
                           min="1" value="1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Satuan</label>
                    <input type="number" name="items[INDEX][unit_price]" class="form-control price-input" 
                           step="0.01" min="0" value="0" required>
                </div>
                <div class="col-md-1">
                    <label class="form-label">Subtotal</label>
                    <div class="form-control-plaintext text-end item-subtotal fw-bold">
                        0
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger remove-item w-100">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

    @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Purchase create script loaded');
    
    const itemsContainer = document.getElementById('itemsContainer');
    const addItemBtn = document.getElementById('addItemBtn');
    const itemTemplate = document.getElementById('itemTemplate');
    let itemCount = 0;

    console.log('Elements found:', {
        itemsContainer,
        addItemBtn,
        itemTemplate
    });

    // Add first item
    addItem();

    // Add Item Button - Click Handler
    if (addItemBtn) {
        addItemBtn.addEventListener('click', function(e) {
            console.log('Add Item Button Clicked');
            e.preventDefault();
            addItem();
        });
    }

    // Supplier change event
    const supplierSelect = document.getElementById('supplier_id');
    if (supplierSelect) {
        supplierSelect.addEventListener('change', function() {
            const supplierId = this.value;
            const suppliers = @json($suppliers);
            const supplier = suppliers.find(s => s.id == supplierId);
            
            if (supplier) {
                document.getElementById('supplier_contact').value = supplier.phone || supplier.email || '-';
            } else {
                document.getElementById('supplier_contact').value = '';
            }
        });
    }

    function addItem() {
        console.log('Adding item', itemCount);
        
        if (!itemTemplate) {
            console.error('Item template not found');
            return;
        }

        const clone = itemTemplate.content.cloneNode(true);
        
        // Convert to string to do replacements
        let html = new XMLSerializer().serializeToString(clone);
        html = html.replace(/INDEX/g, itemCount);
        
        // Parse back to HTML
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;
        const itemDiv = tempDiv.firstElementChild;
        
        // Update name attributes properly
        itemDiv.querySelectorAll('[name]').forEach(el => {
            let name = el.getAttribute('name');
            name = name.replace('INDEX', itemCount);
            el.setAttribute('name', name);
        });
        
        itemsContainer.appendChild(itemDiv);

        // Attach event listeners to new item
        attachItemListeners(itemDiv);
        itemCount++;
        updateSummary();
        
        console.log('Item added, total items:', itemCount);
    }

    function attachItemListeners(itemDiv) {
        const productSelect = itemDiv.querySelector('.product-select');
        const qtyInput = itemDiv.querySelector('.qty-input');
        const priceInput = itemDiv.querySelector('.price-input');
        const removeBtn = itemDiv.querySelector('.remove-item');

        console.log('Attaching listeners to item:', {
            productSelect,
            qtyInput,
            priceInput,
            removeBtn
        });

        if (productSelect) {
            productSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.dataset.price || 0;
                priceInput.value = price;
                updateSubtotal(itemDiv);
            });
        }

        if (qtyInput) {
            qtyInput.addEventListener('input', function() {
                updateSubtotal(itemDiv);
            });
        }

        if (priceInput) {
            priceInput.addEventListener('input', function() {
                updateSubtotal(itemDiv);
            });
        }

        if (removeBtn) {
            removeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Removing item');
                itemDiv.remove();
                updateSummary();
            });
        }
    }

    function updateSubtotal(itemDiv) {
        const qty = parseFloat(itemDiv.querySelector('.qty-input').value) || 0;
        const price = parseFloat(itemDiv.querySelector('.price-input').value) || 0;
        const subtotal = qty * price;
        
        itemDiv.querySelector('.item-subtotal').textContent = 
            'Rp ' + subtotal.toLocaleString('id-ID', {maximumFractionDigits: 0});
        
        updateSummary();
    }

    function updateSummary() {
        let totalAmount = 0;
        let totalQty = 0;
        let itemCount = 0;

        document.querySelectorAll('.purchase-item').forEach(itemDiv => {
            const qty = parseFloat(itemDiv.querySelector('.qty-input').value) || 0;
            const price = parseFloat(itemDiv.querySelector('.price-input').value) || 0;
            const subtotal = qty * price;

            totalAmount += subtotal;
            totalQty += qty;
            itemCount++;
        });

        document.getElementById('totalItems').textContent = itemCount;
        document.getElementById('totalQty').textContent = totalQty;
        document.getElementById('totalAmount').textContent = 
            totalAmount.toLocaleString('id-ID', {maximumFractionDigits: 0});
    }

    // Form validation
    const purchaseForm = document.getElementById('purchaseForm');
    if (purchaseForm) {
        purchaseForm.addEventListener('submit', function(e) {
            const items = document.querySelectorAll('.purchase-item');
            if (items.length === 0) {
                e.preventDefault();
                alert('Tambahkan minimal 1 barang');
                return false;
            }

            const totalAmount = document.getElementById('totalAmount').textContent;
            if (totalAmount === '0') {
                e.preventDefault();
                alert('Total pembelian tidak boleh 0');
                return false;
            }
        });
    }
});
</script>
    @endpush
</x-app-layout>
