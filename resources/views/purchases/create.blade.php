<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary: #2563eb;
            --primary-light: #eff6ff;
            --primary-dark: #1d4ed8;
            --primary-soft: #dbeafe;
            --gray-bg: #f9fafb;
            --white: #ffffff;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --text-light: #9ca3af;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
        }

        body {
            background: var(--gray-bg);
        }

        /* LAYOUT MENTOK KE ATAS - SAMA DENGAN POS */
        .purchase-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 64px);
            overflow: hidden;
            padding: 0;
            background: var(--gray-bg);
        }

        .purchase-main {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 2rem;
        }

        /* HEADER - SAMA DENGAN POS & HELD ORDERS */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
            flex-shrink: 0;
        }

        .header-title-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.01em;
        }

        .page-title span {
            color: var(--primary);
            background: var(--primary-light);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 0.75rem;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: white;
            border: 1.5px solid var(--border-color);
            border-radius: 50px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .back-btn:hover {
            border-color: var(--primary);
            background: var(--primary-light);
            color: var(--primary-dark);
            transform: translateX(-3px);
        }

        .back-btn i {
            font-size: 0.8rem;
        }

        /* ALERTS - MODERN SEPERTI POS */
        .alert-custom {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-lg);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid transparent;
            box-shadow: var(--shadow-sm);
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border-color: #a7f3d0;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-content i {
            font-size: 1.1rem;
        }

        .alert-close {
            background: transparent;
            border: none;
            color: currentColor;
            cursor: pointer;
            opacity: 0.7;
            transition: all 0.2s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
        }

        .alert-close:hover {
            opacity: 1;
            background: rgba(0, 0, 0, 0.05);
        }

        /* CARD - SAMA DENGAN POS & HELD ORDERS */
        .custom-card {
            background: white;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            transition: all 0.2s;
        }

        .custom-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-lg);
        }

        .card-header-custom {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            border-bottom: 1.5px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header-custom h5 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header-custom h5 i {
            color: var(--primary);
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        /* FORM CONTROLS - MODERN */
        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .form-label i {
            color: var(--primary);
            font-size: 0.8rem;
        }

        .form-control, .form-select {
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-control-lg, .form-select-lg {
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
        }

        .form-control:readonly {
            background: #f9fafb;
            border-color: var(--border-color);
            color: var(--text-muted);
        }

        /* ITEM CARD - SEPERTI CART ITEM DI POS */
        .item-card {
            background: white;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-lg);
            margin-bottom: 1rem;
            transition: all 0.2s;
            position: relative;
        }

        .item-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-md);
            background: var(--primary-light);
        }

        .item-card .card-body {
            padding: 1.25rem;
        }

        .item-subtotal {
            font-size: 1rem;
            font-weight: 800;
            color: var(--primary-dark);
            background: var(--primary-light);
            padding: 0.4rem 0.75rem;
            border-radius: 50px;
            text-align: right;
            display: inline-block;
        }

        .remove-item {
            background: #fee2e2;
            color: #dc2626;
            border: 1.5px solid #fecaca;
            border-radius: var(--radius-sm);
            padding: 0.6rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-item:hover {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
            transform: translateY(-2px);
        }

        /* BUTTON ADD ITEM - SAMA DENGAN POS */
        .btn-add-item {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-add-item:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-add-item i {
            font-size: 0.8rem;
        }

        /* SUMMARY CARD - SAMA DENGAN PAYMENT CARD POS */
        .summary-card {
            background: white;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            position: sticky;
            top: 20px;
        }

        .summary-header {
            background: var(--primary-dark);
            padding: 1.25rem 1.5rem;
        }

        .summary-header h5 {
            color: white;
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .summary-header h5 i {
            font-size: 1rem;
        }

        .summary-body {
            padding: 1.5rem;
        }

        .summary-table {
            width: 100%;
        }

        .summary-table tr {
            border-bottom: 1px solid var(--border-color);
        }

        .summary-table tr:last-child {
            border-bottom: none;
        }

        .summary-table td {
            padding: 0.75rem 0;
            font-size: 0.9rem;
        }

        .summary-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .summary-value {
            font-weight: 700;
            color: var(--text-dark);
            text-align: right;
        }

        .total-row {
            border-top: 2px solid var(--border-color);
        }

        .total-row td {
            padding-top: 1rem;
            font-size: 1.1rem;
        }

        .total-label {
            font-weight: 700;
            color: var(--text-dark);
        }

        .total-amount {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.25rem;
        }

        /* STATUS RADIO - MODERN */
        .status-option {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-md);
            margin-bottom: 0.5rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .status-option:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .status-option input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            margin-right: 0.75rem;
        }

        .status-option label {
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            flex: 1;
            margin: 0;
        }

        .status-desc {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-left: 1.5rem;
        }

        /* ACTION BUTTONS - SAMA DENGAN POS */
        .btn-primary-custom {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-lg);
            padding: 0.85rem 1.5rem;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            width: 100%;
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
        }

        .btn-secondary-custom {
            background: white;
            color: var(--text-dark);
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 0.85rem 1.5rem;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            width: 100%;
            text-decoration: none;
        }

        .btn-secondary-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        /* SCROLLBAR - SAMA DENGAN POS */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .purchase-main {
                padding: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .summary-card {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .item-card .col-md-1 {
                margin-top: 1rem;
            }
            
            .remove-item {
                width: 100%;
            }
        }
    </style>

    <!-- LAYOUT MENTOK KE ATAS - SAMA DENGAN POS -->
    <div class="purchase-container">
        <div class="purchase-main custom-scrollbar">
            <!-- HEADER - SAMA DENGAN POS & HELD ORDERS -->
            <div class="page-header">
                <div class="header-title-section">
                    <div class="header-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="page-title">
                        Buat Pembelian Baru
                        <span>Purchase Order</span>
                    </div>
                </div>
                <a href="{{ route('purchases.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>

            <!-- ALERTS - MODERN SEPERTI POS -->
            @if($errors->any())
            <div class="alert-custom alert-danger">
                <div class="alert-content">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong style="font-size: 0.9rem;">Error!</strong>
                        <ul style="margin-top: 0.25rem; margin-bottom: 0; padding-left: 1.25rem;">
                            @foreach($errors->all() as $error)
                            <li style="font-size: 0.85rem;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="alert-close" data-bs-dismiss="alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            <form method="POST" action="{{ route('purchases.store') }}" id="purchaseForm">
                @csrf

                <div class="row g-4">
                    <!-- LEFT COLUMN - 2/3 -->
                    <div class="col-lg-8">
                        <!-- SUPPLIER CARD -->
                        <div class="custom-card">
                            <div class="card-header-custom">
                                <h5>
                                    <i class="fas fa-truck"></i>
                                    Informasi Supplier
                                </h5>
                            </div>
                            <div class="card-body-custom">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="supplier_id" class="form-label">
                                            <i class="fas fa-building"></i>
                                            Pilih Supplier <span style="color: #dc2626;">*</span>
                                        </label>
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
                                        <label for="supplier_contact" class="form-label">
                                            <i class="fas fa-phone"></i>
                                            Kontak
                                        </label>
                                        <input type="text" id="supplier_contact" class="form-control form-control-lg" readonly placeholder="Kontak akan muncul">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ITEMS CARD -->
                        <div class="custom-card">
                            <div class="card-header-custom">
                                <h5>
                                    <i class="fas fa-boxes"></i>
                                    Detail Barang
                                </h5>
                                <button type="button" class="btn-add-item" id="addItemBtn">
                                    <i class="fas fa-plus"></i>
                                    Tambah Barang
                                </button>
                            </div>
                            <div class="card-body-custom">
                                <div id="itemsContainer">
                                    <!-- Items akan ditambahkan di sini via JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN - 1/3 -->
                    <div class="col-lg-4">
                        <!-- SUMMARY CARD - SEPERTI PAYMENT CARD DI POS -->
                        <div class="summary-card">
                            <div class="summary-header">
                                <h5>
                                    <i class="fas fa-credit-card"></i>
                                    Ringkasan Pembelian
                                </h5>
                            </div>
                            <div class="summary-body">
                                <table class="summary-table">
                                    <tr>
                                        <td class="summary-label">Jumlah Item</td>
                                        <td class="summary-value">
                                            <strong id="totalItems">0</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="summary-label">Total Quantity</td>
                                        <td class="summary-value">
                                            <strong id="totalQty">0</strong>
                                        </td>
                                    </tr>
                                    <tr class="total-row">
                                        <td class="total-label">TOTAL PEMBELIAN</td>
                                        <td class="text-end">
                                            <span class="total-amount" id="totalAmount">0</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- NOTES CARD -->
                        <div class="custom-card">
                            <div class="card-header-custom">
                                <h5>
                                    <i class="fas fa-edit"></i>
                                    Catatan
                                </h5>
                            </div>
                            <div class="card-body-custom">
                                <textarea name="notes" class="form-control" rows="3" placeholder="Tambahkan catatan untuk pembelian ini...">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <!-- STATUS CARD -->
                        <div class="custom-card">
                            <div class="card-header-custom">
                                <h5>
                                    <i class="fas fa-tag"></i>
                                    Status Pembelian
                                </h5>
                            </div>
                            <div class="card-body-custom">
                                <div class="status-option">
                                    <input type="radio" name="status" id="statusDraft" value="draft" checked>
                                    <label for="statusDraft">
                                        <strong>Draft</strong>
                                    </label>
                                </div>
                                <div class="status-desc">Simpan sebagai draft, dapat diedit kembali</div>
                                
                                <div class="status-option mt-2">
                                    <input type="radio" name="status" id="statusPending" value="pending">
                                    <label for="statusPending">
                                        <strong>Pending</strong>
                                    </label>
                                </div>
                                <div class="status-desc">Siap untuk diproses / diterima</div>
                            </div>
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn-primary-custom">
                                <i class="fas fa-save"></i>
                                Simpan Pembelian
                            </button>
                            <a href="{{ route('purchases.index') }}" class="btn-secondary-custom">
                                <i class="fas fa-times"></i>
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ITEM TEMPLATE - DESAIN SEPERTI CART ITEM DI POS -->
    <template id="itemTemplate">
        <div class="item-card purchase-item">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">
                            <i class="fas fa-box"></i>
                            Produk
                        </label>
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
                        <label class="form-label">
                            <i class="fas fa-sort-numeric-up"></i>
                            Qty
                        </label>
                        <input type="number" name="items[INDEX][quantity]" class="form-control qty-input" 
                               min="1" value="1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-tag"></i>
                            Harga
                        </label>
                        <input type="number" name="items[INDEX][unit_price]" class="form-control price-input" 
                               step="0.01" min="0" value="0" required>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Subtotal</label>
                        <div class="item-subtotal">Rp 0</div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="remove-item w-100" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Purchase create script loaded - POS Style');
            
            const itemsContainer = document.getElementById('itemsContainer');
            const addItemBtn = document.getElementById('addItemBtn');
            const itemTemplate = document.getElementById('itemTemplate');
            let itemCount = 0;

            // Add first item
            addItem();

            // Add Item Button
            if (addItemBtn) {
                addItemBtn.addEventListener('click', function(e) {
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
                if (!itemTemplate) {
                    console.error('Item template not found');
                    return;
                }

                const clone = itemTemplate.content.cloneNode(true);
                
                // Replace INDEX with current count
                let html = new XMLSerializer().serializeToString(clone);
                html = html.replace(/INDEX/g, itemCount);
                
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                const itemDiv = tempDiv.firstElementChild;
                
                // Update name attributes
                itemDiv.querySelectorAll('[name]').forEach(el => {
                    let name = el.getAttribute('name');
                    name = name.replace('INDEX', itemCount);
                    el.setAttribute('name', name);
                });
                
                itemsContainer.appendChild(itemDiv);
                attachItemListeners(itemDiv);
                itemCount++;
                updateSummary();
            }

            function attachItemListeners(itemDiv) {
                const productSelect = itemDiv.querySelector('.product-select');
                const qtyInput = itemDiv.querySelector('.qty-input');
                const priceInput = itemDiv.querySelector('.price-input');
                const removeBtn = itemDiv.querySelector('.remove-item');

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

                    const totalAmount = document.getElementById('totalAmount').textContent.replace(/[^0-9]/g, '');
                    if (totalAmount === '0' || totalAmount === '') {
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