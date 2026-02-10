<x-app-layout>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="mb-0">
                    <i class="fas fa-undo-alt me-2"></i>Buat Retur Barang
                </h2>
                <small class="text-muted">Retur pembelian barang dari supplier</small>
            </div>
        </div>

        <form action="{{ route('returns.store') }}" method="POST" id="returnForm">
            @csrf

            <div class="row">
                <!-- Form Area -->
                <div class="col-lg-8">
                    <!-- Purchase Selection -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-dolly me-2"></i>Pilih Pembelian
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nomor Pembelian <span class="text-danger">*</span></label>
                                <select name="purchase_id" id="purchaseSelect" class="form-select @error('purchase_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Pembelian --</option>
                                    @foreach($purchases as $purchase)
                                        <option value="{{ $purchase->id }}" 
                                                data-supplier="{{ $purchase->supplier->name }}"
                                                data-supplier-id="{{ $purchase->supplier_id }}">
                                            {{ $purchase->purchase_number }} - {{ $purchase->supplier->name }} 
                                            (Rp {{ number_format($purchase->total_amount, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('purchase_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Supplier Info -->
                            <div id="supplierInfo" class="alert alert-info d-none">
                                <strong>Supplier:</strong> <span id="supplierName"></span><br>
                                <strong>Nomor Pembelian:</strong> <span id="purchaseNumber"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Return Items -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">
                                        <i class="fas fa-list me-2"></i>Daftar Item Retur
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="addItemBtn">
                                        <i class="fas fa-plus me-1"></i>Tambah Item
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless" id="itemsTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="25%">Produk</th>
                                            <th width="15%" class="text-center">Qty Beli</th>
                                            <th width="15%" class="text-center">Qty Retur</th>
                                            <th width="15%" class="text-end">Harga Satuan</th>
                                            <th width="15%" class="text-end">Subtotal</th>
                                            <th width="8%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemsBody">
                                        <!-- Items will be added here -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Hidden template for items -->
                            <template id="itemTemplate">
                                <tr class="item-row">
                                    <td>
                                        <input type="hidden" name="items[INDEX].product_id" class="product-id">
                                        <input type="hidden" name="items[INDEX].purchase_item_id" class="purchase-item-id">
                                        <input type="hidden" name="items[INDEX].unit_price" class="unit-price">
                                        <span class="product-name"></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="qty-purchased"></span>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" name="items[INDEX].quantity" class="form-control form-control-sm text-center qty-return" min="1" required>
                                    </td>
                                    <td class="text-end">
                                        <span class="unit-price-display"></span>
                                    </td>
                                    <td class="text-end">
                                        <strong class="subtotal-amount">0</strong>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="item-row-reason">
                                    <td colspan="6">
                                        <textarea name="items[INDEX].reason" class="form-control form-control-sm" 
                                                  rows="2" placeholder="Alasan retur item ini..." required></textarea>
                                    </td>
                                </tr>
                            </template>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-note-sticky me-2"></i>Catatan Tambahan
                            </h6>
                        </div>
                        <div class="card-body">
                            <textarea name="notes" class="form-control" rows="3" 
                                      placeholder="Catatan tambahan untuk retur ini..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Summary Area -->
                <div class="col-lg-4">
                    <!-- Summary Card -->
                    <div class="card mb-4 sticky-top" style="top: 20px;">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-calculator me-2"></i>Ringkasan
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Alasan Retur Umum</label>
                                <input type="text" name="reason" class="form-control" 
                                       placeholder="Contoh: Barang rusak" value="{{ old('reason') }}">
                            </div>

                            <!-- Summary Items -->
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Jumlah Item:</span>
                                    <strong id="totalItems">0</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Quantity:</span>
                                    <strong id="totalQty">0</strong>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="h6">Total Nilai Retur:</span>
                                    <strong class="h6" id="totalAmount">Rp 0</strong>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Buat Retur
                                </button>
                                <a href="{{ route('returns.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const purchaseSelect = document.getElementById('purchaseSelect');
        const supplierInfo = document.getElementById('supplierInfo');
        const supplierName = document.getElementById('supplierName');
        const purchaseNumber = document.getElementById('purchaseNumber');
        const addItemBtn = document.getElementById('addItemBtn');
        const itemsBody = document.getElementById('itemsBody');
        const itemTemplate = document.getElementById('itemTemplate');
        let itemIndex = 0;

        // Handle purchase selection
        purchaseSelect.addEventListener('change', function() {
            itemsBody.innerHTML = '';
            itemIndex = 0;

            if (this.value) {
                const option = this.options[this.selectedIndex];
                supplierName.textContent = option.dataset.supplier;
                purchaseNumber.textContent = option.textContent.split(' - ')[0];
                supplierInfo.classList.remove('d-none');

                // Load purchase items
                loadPurchaseItems(this.value);
            } else {
                supplierInfo.classList.add('d-none');
            }
        });

        // Load purchase items via AJAX
        function loadPurchaseItems(purchaseId) {
            fetch(`/return/api/purchase/${purchaseId}/items`)
                .then(response => response.json())
                .then(items => {
                    console.log('Items loaded:', items);
                    // Items are preloaded, user can select which ones to return
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat item pembelian');
                });
        }

        // Add item button
        addItemBtn.addEventListener('click', function() {
            if (!purchaseSelect.value) {
                alert('Pilih pembelian terlebih dahulu');
                return;
            }

            const modal = document.createElement('div');
            modal.innerHTML = `
                <div class="modal fade" id="selectItemModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pilih Item untuk Diretur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="itemListBody">
                                Memuat...
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            const modalEl = new bootstrap.Modal(modal.querySelector('.modal'));

            fetch(`/return/api/purchase/${purchaseSelect.value}/items`)
                .then(response => response.json())
                .then(items => {
                    let html = '<table class="table table-sm"><thead class="table-light"><tr><th>Produk</th><th class="text-center">Qty</th><th>Harga</th><th></th></tr></thead><tbody>';
                    
                    items.forEach(item => {
                        html += `
                            <tr>
                                <td>${item.product_name}</td>
                                <td class="text-center">${item.quantity_purchased}</td>
                                <td>Rp ${item.unit_price.toLocaleString('id-ID')}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-primary select-item-btn" 
                                            data-product-id="${item.product_id}"
                                            data-purchase-item-id="${item.id}"
                                            data-product-name="${item.product_name}"
                                            data-qty="${item.quantity_purchased}"
                                            data-price="${item.unit_price}">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    html += '</tbody></table>';
                    modal.querySelector('#itemListBody').innerHTML = html;

                    // Handle item selection
                    modal.querySelectorAll('.select-item-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            addItemRow({
                                product_id: this.dataset.productId,
                                purchase_item_id: this.dataset.purchaseItemId,
                                product_name: this.dataset.productName,
                                qty_purchased: this.dataset.qty,
                                unit_price: this.dataset.price
                            });
                            modalEl.hide();
                            modal.remove();
                        });
                    });
                });

            modalEl.show();
        });

        // Add item row
        function addItemRow(itemData) {
            const row = itemTemplate.content.cloneNode(true);
            const itemRow = row.querySelector('.item-row');
            const itemRowReason = row.querySelector('.item-row-reason');

            // Replace INDEX with actual index
            const htmlString = new XMLSerializer().serializeToString(row);
            const indexedHtml = htmlString.replace(/\[INDEX\]/g, `[${itemIndex}]`);
            
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = indexedHtml;
            const indexedRow = tempDiv.querySelectorAll('tr');

            itemsBody.appendChild(indexedRow[0]);
            itemsBody.appendChild(indexedRow[1]);

            const newRow = itemsBody.querySelector(`[data-index="${itemIndex}"]`);
            const rows = itemsBody.querySelectorAll('tr');
            const lastRow = rows[rows.length - 2];

            // Populate data
            lastRow.querySelector('.product-id').value = itemData.product_id;
            lastRow.querySelector('.purchase-item-id').value = itemData.purchase_item_id;
            lastRow.querySelector('.unit-price').value = itemData.unit_price;
            lastRow.querySelector('.product-name').textContent = itemData.product_name;
            lastRow.querySelector('.qty-purchased').textContent = itemData.qty_purchased;
            lastRow.querySelector('.unit-price-display').textContent = `Rp ${parseInt(itemData.unit_price).toLocaleString('id-ID')}`;

            // Add quantity input listener
            const qtyInput = lastRow.querySelector('.qty-return');
            qtyInput.addEventListener('input', calculateTotals);

            // Add remove button listener
            const removeBtn = lastRow.querySelector('.remove-item');
            removeBtn.addEventListener('click', function() {
                const qtyRow = lastRow.nextElementSibling;
                lastRow.remove();
                if (qtyRow && qtyRow.classList.contains('item-row-reason')) {
                    qtyRow.remove();
                }
                calculateTotals();
            });

            itemIndex++;
            calculateTotals();
        }

        // Calculate totals
        function calculateTotals() {
            let totalItems = 0;
            let totalQty = 0;
            let totalAmount = 0;

            itemsBody.querySelectorAll('.item-row').forEach(row => {
                const qty = parseInt(row.querySelector('.qty-return').value) || 0;
                const unitPrice = parseInt(row.querySelector('.unit-price').value) || 0;
                const subtotal = qty * unitPrice;

                row.querySelector('.subtotal-amount').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;

                totalItems++;
                totalQty += qty;
                totalAmount += subtotal;
            });

            document.getElementById('totalItems').textContent = totalItems;
            document.getElementById('totalQty').textContent = totalQty;
            document.getElementById('totalAmount').textContent = `Rp ${totalAmount.toLocaleString('id-ID')}`;
        }
    });
    </script>
</x-app-layout>
