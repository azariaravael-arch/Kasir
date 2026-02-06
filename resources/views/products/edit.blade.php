<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card shadow-premium">
                <div class="mb-8 pb-4 border-b border-gray-50 flex items-center justify-between">
                    <h2 class="text-xl font-black text-gray-900 flex items-center gap-3">
                        <i class="fas fa-edit text-primary-500"></i> Edit Produk
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

                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div
                        class="p-6 bg-primary-50/50 rounded-2xl flex items-center gap-6 border border-primary-100 mb-8">
                        <div
                            class="w-24 h-24 bg-white border-2 border-primary-100 rounded-xl overflow-hidden flex items-center justify-center shadow-sm">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-4xl opacity-30">📦</span>
                            @endif
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1 italic">
                                Preview Produk</div>
                            <div class="text-xl font-black text-gray-900">{{ $product->name }}</div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-tighter">{{ $product->sku }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="name"
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Nama
                            Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">SKU
                                (Kode)</label>
                            <div
                                class="block w-full bg-gray-100 border border-gray-200 text-gray-400 rounded-xl py-2.5 px-4 text-sm font-bold cursor-not-allowed">
                                {{ $product->sku }}
                            </div>
                            <input type="hidden" name="sku" value="{{ $product->sku }}">
                            <p class="mt-2 text-[10px] text-gray-400 italic px-1">*SKU tidak dapat diubah</p>
                        </div>

                        <div>
                            <label for="category"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Kategori</label>
                            <select name="category" id="category" required
                                class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                                <option value="Food" {{ old('category', $product->category) == 'Food' ? 'selected' : '' }}>Food</option>
                                <option value="Drink" {{ old('category', $product->category) == 'Drink' ? 'selected' : '' }}>Drink</option>
                                <option value="Snack" {{ old('category', $product->category) == 'Snack' ? 'selected' : '' }}>Snack</option>
                                <option value="General" {{ old('category', $product->category) == 'General' ? 'selected' : '' }}>General</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Harga
                                (Rp)</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                                required min="0"
                                class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                        </div>

                        <div>
                            <label for="stock"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                                required min="0"
                                class="block w-full border-gray-100 bg-gray-50/50 rounded-xl shadow-sm focus:ring-primary-500 focus:border-primary-500 font-bold text-gray-900 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="image"
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Ganti
                            Gambar (Opsional)</label>
                        <div class="p-4 border-2 border-dashed border-gray-100 rounded-xl bg-gray-50/30">
                            <input type="file" name="image" id="image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:uppercase file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-all cursor-pointer">
                        </div>
                        <p class="mt-2 text-[10px] text-gray-400 italic px-1">Biarkan kosong jika tidak ingin mengganti
                            gambar.</p>
                    </div>

                    <div class="pt-6 flex gap-4 border-t border-gray-50">
                        <button type="submit" class="primary-btn flex-1">
                            <i class="fas fa-sync-alt mr-2"></i> PERBARUI PRODUK
                        </button>
                        <a href="{{ route('products.index') }}" class="secondary-btn flex-1 text-center">
                            BATAL
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>