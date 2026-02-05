<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <strong class="font-bold text-sm">Ada kesalahan input:</strong>
                        <ul class="mt-2 text-xs list-disc list-inside">
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

                    <div class="p-4 bg-gray-50 rounded-lg flex items-center gap-4 border mb-6">
                        <div class="w-20 h-20 bg-white border rounded overflow-hidden flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl">📦</span>
                            @endif
                        </div>
                        <div>
                            <div class="text-lg font-bold text-gray-900">{{ $product->name }}</div>
                            <div class="text-xs text-black font-bold uppercase">{{ $product->sku }}</div>
                        </div>
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Nama
                            Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 font-bold text-gray-900">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">SKU</label>
                            <div
                                class="mt-1 block w-full bg-gray-50 border border-gray-200 text-gray-400 rounded-md py-2 px-3 text-sm font-bold">
                                {{ $product->sku }}
                            </div>
                            <input type="hidden" name="sku" value="{{ $product->sku }}">
                            <p class="mt-1 text-[10px] text-gray-400 italic">*SKU tergenerate otomatis</p>
                        </div>

                        <div>
                            <label for="category"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Kategori</label>
                            <select name="category" id="category" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 font-bold text-gray-900">
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
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Harga
                                (Rp)</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                                required min="0"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 font-bold text-gray-900">
                        </div>

                        <div>
                            <label for="stock"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                                required min="0"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 font-bold text-gray-900">
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Ganti
                            Gambar (Opsional)</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-black file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-2 text-xs text-black">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit"
                            class=" class=inline-flex justify-center py-2 px-6 border border-gray-300 shadow-sm text-sm font-bold rounded-md text-black bg-white hover:bg-gray-50 focus:outline-none transition">
                            SIMPAN
                        </button>
                        <a href="{{ route('products.index') }}"
                            class="inline-flex justify-center py-2 px-6 border border-gray-300 shadow-sm text-sm font-bold rounded-md text-black bg-white hover:bg-gray-50 focus:outline-none transition">
                            BATAL
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>