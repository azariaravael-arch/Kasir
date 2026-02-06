<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card shadow-premium">
                <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-50">
                    <h2 class="text-2xl font-black text-gray-900 flex items-center gap-3">
                        <i class="fas fa-boxes text-primary-500"></i> Daftar Produk
                    </h2>
                    <a href="{{ route('products.create') }}" class="primary-btn flex items-center gap-2">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </a>
                </div>

                @if ($message = session('success'))
                    <div class="bg-primary-50 border border-primary-100 text-primary-700 px-4 py-3 rounded-xl relative mb-6 flex items-center gap-3"
                        role="alert">
                        <i class="fas fa-check-circle"></i>
                        <span class="font-bold text-sm">{{ $message }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                    <table class="min-w-full text-gray-950">
                        <thead class="bg-gray-50/50">
                            <tr class="text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                <th class="px-6 py-4">Gambar</th>
                                <th class="px-6 py-4">Nama Produk</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Harga</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">
                            @forelse($products as $product)
                                <tr class="group hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="bg-gray-50 rounded-lg border border-gray-100 overflow-hidden flex items-center justify-center shadow-sm"
                                            style="width: 50px; height: 50px;">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <span class="text-xl opacity-30">📦</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="text-sm font-bold text-gray-900 group-hover:text-primary-600 transition-colors">
                                            {{ $product->name }}</div>
                                        <div class="text-[10px] font-bold text-gray-400 uppercase">{{ $product->sku }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1 text-[10px] font-black uppercase rounded-full bg-primary-50 text-primary-700 border border-primary-100">
                                            {{ $product->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-primary-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="text-xs font-bold px-2.5 py-1 bg-gray-100 rounded-lg text-gray-600">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-600 rounded-lg hover:bg-primary-500 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-400 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm"
                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic text-sm">
                                        <div class="flex flex-col items-center gap-2">
                                            <i class="fas fa-inbox text-4xl opacity-20"></i>
                                            <span>Belum ada data produk.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>