<x-app-layout>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="mb-0">
                    <i class="fas fa-undo-alt me-2"></i>Edit Retur Barang
                </h2>
                <small class="text-muted">{{ $return->return_number }}</small>
            </div>
        </div>

        @if($return->status !== 'draft')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                Hanya retur dengan status draft yang bisa diubah. Status saat ini: <strong>{{ ucfirst($return->status) }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <a href="{{ route('returns.show', $return) }}" class="btn btn-secondary">Kembali</a>
            @php exit @endphp
        @endif

        <form action="{{ route('returns.update', $return) }}" method="POST" id="returnForm">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Form Area -->
                <div class="col-lg-8">
                    <!-- Purchase Info -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-dolly me-2"></i>Informasi Pembelian
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>No Pembelian:</strong><br>
                                    {{ $return->purchase->purchase_number }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Supplier:</strong><br>
                                    {{ $return->supplier->name }}
                                </div>
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
                                        <!-- Items will be loaded here -->
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
                                      placeholder="Catatan tambahan untuk retur ini...">{{ $return->notes }}</textarea>
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
                                       value="{{ $return->reason }}">
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
                                    <i class="fas fa-save me-1"></i>Simpan Perubahan
                                </button>
                                <a href="{{ route('returns.show', $return) }}" class="btn btn-outline-secondary">
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
        const addItemBtn = document.getElementById('addItemBtn');
        const itemsBody = document.getElementById('itemsBody');
        const itemTemplate = document.getElementById('itemTemplate');
        let itemIndex = 0;

        // Load existing items
        const existingItems = @json($return->items);
        const purchaseItems = @json($return->purchase->items);

        existingItems.forEach((item, index) => {
            const purchaseItem = purchaseItems.find(pi => pi.id === item.purchase_item_id);
            addItemRow({
                product_id: item.product_id,
                purchase_item_id: item.purchase_item_id,
                product_name: item.product.name,
                qty_purchased: purchaseItem ? purchaseItem.quantity : item.quantity,
                unit_price: item.unit_price,
                qty_return: item.quantity,
                reason: item.reason
            }, index);
        });

        // Add item button
        addItemBtn.addEventListener('click', function() {
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

            fetch(`/return/api/purchase/{{ $return->purchase_id }}/items`)
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
        function addItemRow(itemData, index = null) {
            if (index === null) {
                index = itemIndex;
            }

            const row = itemTemplate.content.cloneNode(true);
            const htmlString = new XMLSerializer().serializeToString(row);
            const indexedHtml = htmlString.replace(/\[INDEX\]/g, `[${index}]`);
            
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = indexedHtml;
            const indexedRows = tempDiv.querySelectorAll('tr');

            itemsBody.appendChild(indexedRows[0]);
            itemsBody.appendChild(indexedRows[1]);

            const rows = itemsBody.querySelectorAll('tr');
            const lastRow = rows[rows.length - 2];

            // Populate data
            lastRow.querySelector('.product-id').value = itemData.product_id;
            lastRow.querySelector('.purchase-item-id').value = itemData.purchase_item_id;
            lastRow.querySelector('.unit-price').value = itemData.unit_price;
            lastRow.querySelector('.product-name').textContent = itemData.product_name;
            lastRow.querySelector('.qty-purchased').textContent = itemData.qty_purchased;
            lastRow.querySelector('.unit-price-display').textContent = `Rp ${parseInt(itemData.unit_price).toLocaleString('id-ID')}`;
            lastRow.querySelector('.qty-return').value = itemData.qty_return || 1;
            lastRow.nextElementSibling.querySelector('textarea').value = itemData.reason || '';

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

            if (index === itemIndex) {
                itemIndex++;
            }
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
