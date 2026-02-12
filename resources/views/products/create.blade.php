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
        .product-create-container {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 64px);
            overflow: hidden;
            padding: 0;
            background: var(--gray-bg);
        }

        .product-create-main {
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

        /* BACK BUTTON - SAMA DENGAN POS */
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

        /* CARD - SAMA DENGAN POS */
        .custom-card {
            background: white;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s;
            max-width: 900px;
            margin: 0 auto;
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

        .card-header-custom h2 {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-header-custom h2 i {
            color: var(--primary);
        }

        .card-body-custom {
            padding: 1.75rem 1.5rem;
        }

        /* FORM LABEL - SAMA DENGAN POS */
        .form-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            padding-left: 0.25rem;
        }

        .form-label i {
            color: var(--primary);
            margin-right: 0.25rem;
        }

        /* FORM CONTROLS - SAMA DENGAN POS */
        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-lg);
            background: #f9fafb;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: white;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* SELECT - SAMA DENGAN POS */
        .form-select {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-lg);
            background: #f9fafb;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            transition: all 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px;
        }

        .form-select:focus {
            border-color: var(--primary);
            background: white;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* BUTTON TAMBAH KATEGORI */
        .btn-add-category {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.4rem 0.8rem;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            border: 1px solid var(--primary-soft);
            transition: all 0.2s;
        }

        .btn-add-category:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-1px);
        }

        .btn-add-category i {
            font-size: 0.65rem;
        }

        /* FILE UPLOAD - SAMA DENGAN POS */
        .file-upload-area {
            padding: 1.25rem;
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-xl);
            background: #f9fafb;
            transition: all 0.2s;
        }

        .file-upload-area:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .file-input {
            display: block;
            width: 100%;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .file-input::file-selector-button {
            margin-right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            border: none;
            background: white;
            color: var(--primary-dark);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 1.5px solid var(--border-color);
            transition: all 0.2s;
            cursor: pointer;
        }

        .file-input::file-selector-button:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* ALERT ERRORS - SAMA DENGAN POS */
        .alert-custom {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-lg);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            border: 1px solid transparent;
            box-shadow: var(--shadow-sm);
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .alert-icon {
            font-size: 1.1rem;
            margin-top: 0.1rem;
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 700;
            font-size: 0.85rem;
            margin-bottom: 0.25rem;
        }

        .alert-list {
            margin: 0;
            padding-left: 1.25rem;
            font-size: 0.8rem;
            opacity: 0.9;
        }

        .alert-list li {
            margin-bottom: 0.1rem;
        }

        /* ACTION BUTTONS - SAMA DENGAN POS */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1.5px solid var(--border-color);
        }

        .btn-primary-custom {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.85rem 1.5rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
        }

        .btn-primary-custom i {
            font-size: 0.9rem;
        }

        .btn-secondary-custom {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.85rem 1.5rem;
            background: white;
            color: var(--text-dark);
            border: 1.5px solid var(--border-color);
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-secondary-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        /* MODAL - STYLING POS */
        .modal-content-custom {
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border-color);
            overflow: hidden;
        }

        .modal-header-custom {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            border-bottom: 1.5px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title-custom {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
        }

        .modal-title-custom i {
            color: var(--primary);
        }

        .modal-body-custom {
            padding: 1.5rem;
        }

        .modal-footer-custom {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            border-top: 1.5px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .btn-modal-secondary {
            padding: 0.6rem 1.2rem;
            background: white;
            color: var(--text-dark);
            border: 1.5px solid var(--border-color);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .btn-modal-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .btn-modal-primary {
            padding: 0.6rem 1.2rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-modal-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        /* FORM GROUP */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
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
        @media (max-width: 768px) {
            .product-create-main {
                padding: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .grid-2 {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .card-body-custom {
                padding: 1.25rem;
            }
        }
    </style>

    <!-- LAYOUT MENTOK KE ATAS - SAMA DENGAN POS -->
    <div class="product-create-container">
        <div class="product-create-main custom-scrollbar">
            <!-- HEADER - SAMA DENGAN POS & HELD ORDERS -->
            <div class="page-header">
                <div class="header-title-section">
                    <div class="header-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="page-title">
                        Tambah Produk Baru
                        <span>Product</span>
                    </div>
                </div>
                <a href="{{ route('products.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar
                </a>
            </div>

            <!-- FORM CARD -->
            <div class="custom-card">
                <div class="card-header-custom">
                    <h2>
                        <i class="fas fa-plus-circle"></i>
                        Form Tambah Produk
                    </h2>
                </div>
                <div class="card-body-custom">
                    <!-- ERROR ALERTS -->
                    @if ($errors->any())
                        <div class="alert-custom alert-danger">
                            <i class="fas fa-exclamation-triangle alert-icon"></i>
                            <div class="alert-content">
                                <div class="alert-title">TERDAPAT KESALAHAN INPUT:</div>
                                <ul class="alert-list">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Produk -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-box"></i>
                                Nama Produk <span style="color: #dc2626;">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                   class="form-control" placeholder="Masukkan nama produk" required>
                        </div>

                        <!-- Grid 2 Kolom: SKU & Kategori -->
                        <div class="grid-2">
                            <div class="form-group">
                                <label for="sku" class="form-label">
                                    <i class="fas fa-barcode"></i>
                                    SKU / Kode <span style="color: #dc2626;">*</span>
                                </label>
                                <input type="text" name="sku" id="sku" value="{{ old('sku') }}" 
                                       class="form-control" placeholder="Contoh: PRD-001" required>
                            </div>

                            <div class="form-group">
                                <div class="flex justify-between items-center mb-2">
                                    <label for="category_id" class="form-label" style="margin-bottom: 0;">
                                        <i class="fas fa-tag"></i>
                                        Kategori <span style="color: #dc2626;">*</span>
                                    </label>
                                    <button type="button" class="btn-add-category" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                        <i class="fas fa-plus"></i>
                                        Tambah Kategori
                                    </button>
                                </div>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Grid 2 Kolom: Harga & Stok -->
                        <div class="grid-2">
                            <div class="form-group">
                                <label for="price" class="form-label">
                                    <i class="fas fa-money-bill-wave"></i>
                                    Harga (Rp) <span style="color: #dc2626;">*</span>
                                </label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" 
                                       class="form-control" placeholder="0" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="stock" class="form-label">
                                    <i class="fas fa-cubes"></i>
                                    Stok <span style="color: #dc2626;">*</span>
                                </label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock') }}" 
                                       class="form-control" placeholder="0" min="0" required>
                            </div>
                        </div>

                        <!-- Gambar Produk -->
                        <div class="form-group">
                            <label for="image" class="form-label">
                                <i class="fas fa-image"></i>
                                Gambar Produk
                            </label>
                            <div class="file-upload-area">
                                <input type="file" name="image" id="image" accept="image/*" class="file-input">
                                <p class="text-xs text-gray-400 mt-2" style="margin-left: 0.25rem;">
                                    <i class="fas fa-info-circle"></i> Format: JPG, PNG. Maks: 2MB
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button type="submit" class="btn-primary-custom">
                                <i class="fas fa-save"></i>
                                Simpan Produk
                            </button>
                            <a href="{{ route('products.index') }}" class="btn-secondary-custom">
                                <i class="fas fa-times"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD CATEGORY MODAL - STYLING POS -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Kategori Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body-custom">
                    <form id="addCategoryForm">
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label for="categoryName" class="form-label">
                                <i class="fas fa-tag"></i>
                                Nama Kategori <span style="color: #dc2626;">*</span>
                            </label>
                            <input type="text" class="form-control" id="categoryName" name="name" 
                                   placeholder="Contoh: Makanan Berat" required
                                   style="background: white;">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="categoryDesc" class="form-label">
                                <i class="fas fa-align-left"></i>
                                Deskripsi
                            </label>
                            <textarea class="form-control" id="categoryDesc" name="description" 
                                      rows="3" placeholder="Opsional - Deskripsi kategori"
                                      style="background: white;"></textarea>
                        </div>
                    </form>
                    <div id="categoryAlert" style="margin-top: 1rem;"></div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Batal
                    </button>
                    <button type="button" class="btn-modal-primary" id="saveCategoryBtn">
                        <i class="fas fa-save"></i>
                        Simpan Kategori
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveCategoryBtn = document.getElementById('saveCategoryBtn');
            if (saveCategoryBtn) {
                saveCategoryBtn.addEventListener('click', function() {
                    const form = document.getElementById('addCategoryForm');
                    const name = document.getElementById('categoryName').value;
                    const description = document.getElementById('categoryDesc').value;
                    const alertDiv = document.getElementById('categoryAlert');

                    if (!name.trim()) {
                        alertDiv.innerHTML = '<div class="alert alert-warning" style="border-radius: var(--radius-md); padding: 0.75rem 1rem; background: #fffbeb; border: 1px solid #fcd34d; color: #92400e;">Nama kategori tidak boleh kosong</div>';
                        return;
                    }

                    fetch('{{ route("categories.store.api") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            name: name,
                            description: description
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Add new option to select
                            const select = document.getElementById('category_id');
                            const option = document.createElement('option');
                            option.value = data.category.id;
                            option.textContent = data.category.name;
                            select.appendChild(option);
                            select.value = data.category.id;

                            // Reset form
                            form.reset();
                            alertDiv.innerHTML = '<div class="alert alert-success" style="border-radius: var(--radius-md); padding: 0.75rem 1rem; background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46;">Kategori berhasil ditambahkan!</div>';
                            
                            // Close modal after 1 second
                            setTimeout(() => {
                                const modal = bootstrap.Modal.getInstance(document.getElementById('addCategoryModal'));
                                if (modal) modal.hide();
                                alertDiv.innerHTML = '';
                            }, 1000);
                        } else {
                            alertDiv.innerHTML = '<div class="alert alert-danger" style="border-radius: var(--radius-md); padding: 0.75rem 1rem; background: #fee2e2; border: 1px solid #fecaca; color: #991b1b;">Gagal menambah kategori</div>';
                        }
                    })
                    .catch(error => {
                        alertDiv.innerHTML = '<div class="alert alert-danger" style="border-radius: var(--radius-md); padding: 0.75rem 1rem; background: #fee2e2; border: 1px solid #fecaca; color: #991b1b;">Error: ' + error + '</div>';
                    });
                });
            }

            // Reset form when modal is hidden
            const addCategoryModal = document.getElementById('addCategoryModal');
            if (addCategoryModal) {
                addCategoryModal.addEventListener('hidden.bs.modal', function () {
                    const form = document.getElementById('addCategoryForm');
                    const alertDiv = document.getElementById('categoryAlert');
                    if (form) form.reset();
                    if (alertDiv) alertDiv.innerHTML = '';
                });
            }
        });
    </script>
</x-app-layout>