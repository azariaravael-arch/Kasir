<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card shadow-premium">
                <div class="mb-8 pb-4 border-b border-gray-50 flex items-center justify-between">
                    <h2 class="text-xl font-black text-gray-900 flex items-center gap-3">
                        <i class="fas fa-plus-circle text-primary-500"></i> Tambah Produk Baru
                    </h2>
                    <a href="{{ route('products.index') }}"
                        class="text-xs font-bold text-gray-400 hover:text-primary-500 transition-colors">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl relative mb-6"
                        role="alert">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong class="font-bold text-sm">Ada kesalahan input:</strong>
                        </div>
                        <ul class="text-xs list-disc list-inside opacity-80">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div>
                        <label for="name"
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Nama
                            Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="sku"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">SKU
                                / Kode</label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required
                                class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                        </div>

                        <div>
                            <label for="category_id"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1 flex items-center justify-between">
                                <span>Kategori</span>
                                <button type="button" class="text-xs text-primary-500 hover:text-primary-600" data-bs-toggle="modal" data-bs-target="#addCategoryModal" title="Tambah kategori baru">
                                    <i class="fas fa-plus-circle me-1"></i>Tambah
                                </button>
                            </label>
                            <select name="category_id" id="category_id" required
                                class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Harga
                                (Rp)</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0"
                                class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                        </div>

                        <div>
                            <label for="stock"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required min="0"
                                class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="image"
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Gambar
                            Produk</label>
                        <div class="p-4 border-2 border-dashed border-gray-100 rounded-xl bg-gray-50/30">
                            <input type="file" name="image" id="image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:uppercase file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-all cursor-pointer">
                        </div>
                    </div>

                    <div class="pt-6 flex gap-4 border-t border-gray-50">
                        <button type="submit" class="primary-btn flex-1">
                            <i class="fas fa-save mr-2"></i> SIMPAN PRODUK
                        </button>
                        <a href="{{ route('products.index') }}" class="secondary-btn flex-1 text-center">
                            BATAL
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="addCategoryModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Kategori Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label fw-bold">Nama Kategori</label>
                            <input type="text" class="form-control" id="categoryName" name="name" placeholder="Contoh: Makanan Berat" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryDesc" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="categoryDesc" name="description" rows="3" placeholder="Opsional - Deskripsi kategori"></textarea>
                        </div>
                    </form>
                    <div id="categoryAlert"></div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveCategoryBtn">
                        <i class="fas fa-save me-1"></i>Simpan Kategori
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('saveCategoryBtn').addEventListener('click', function() {
            const form = document.getElementById('addCategoryForm');
            const name = document.getElementById('categoryName').value;
            const description = document.getElementById('categoryDesc').value;
            const alertDiv = document.getElementById('categoryAlert');

            if (!name.trim()) {
                alertDiv.innerHTML = '<div class="alert alert-warning">Nama kategori tidak boleh kosong</div>';
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
                    alertDiv.innerHTML = '<div class="alert alert-success">Kategori berhasil ditambahkan!</div>';
                    
                    // Close modal after 1 second
                    setTimeout(() => {
                        bootstrap.Modal.getInstance(document.getElementById('addCategoryModal')).hide();
                    }, 1000);
                } else {
                    alertDiv.innerHTML = '<div class="alert alert-danger">Gagal menambah kategori</div>';
                }
            })
            .catch(error => {
                alertDiv.innerHTML = '<div class="alert alert-danger">Error: ' + error + '</div>';
            });
        });
    </script>
</x-app-layout>