<x-app-layout>
    <div class="py-4 sm:py-8 px-3 sm:px-6">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-black text-gray-900 flex items-center gap-3 mb-2">
                    <i class="fas fa-cog text-primary-500"></i> Pengaturan Aplikasi
                </h1>
                <p class="text-gray-500 text-sm sm:text-base">Kelola pengaturan umum sistem kasir</p>
            </div>

            <!-- Settings Tabs -->
            <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200">
                <button onclick="switchTab('toko')"
                    class="px-4 py-3 font-bold text-sm sm:text-base border-b-2 border-primary-500 text-primary-600 transition"
                    id="tab-toko">
                    <i class="fas fa-store mr-2"></i> Toko
                </button>
                <button onclick="switchTab('tampilan')"
                    class="px-4 py-3 font-bold text-sm sm:text-base text-gray-600 hover:text-gray-900 transition"
                    id="tab-tampilan">
                    <i class="fas fa-palette mr-2"></i> Tampilan
                </button>
            </div>

            <!-- Content -->
            <div class="space-y-6">

                <!-- TAB: TOKO (Store Settings) -->
                <div id="section-toko" class="space-y-6">
                    <div class="premium-card">
                        <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 pb-4 border-b flex items-center gap-2">
                            <i class="fas fa-store text-primary-500"></i> Informasi Toko
                        </h2>

                        <form action="{{ route('settings.update', 'store') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Nama Toko -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-heading mr-1"></i> Nama Toko
                                </label>
                                <input type="text" name="store_name" 
                                    value="{{ old('store_name', $settings['store_name'] ?? 'Toko Saya') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Nama toko Anda">
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt mr-1"></i> Alamat
                                </label>
                                <textarea name="store_address" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Alamat lengkap toko">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                            </div>

                            <!-- Telepon & Email -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">
                                        <i class="fas fa-phone mr-1"></i> Nomor Telepon
                                    </label>
                                    <input type="text" name="store_phone" 
                                        value="{{ old('store_phone', $settings['store_phone'] ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Contoh: 0812345678">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-1"></i> Email
                                    </label>
                                    <input type="email" name="store_email" 
                                        value="{{ old('store_email', $settings['store_email'] ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Contoh: toko@example.com">
                                </div>
                            </div>

                            <!-- Website -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-globe mr-1"></i> Website
                                </label>
                                <input type="url" name="store_website" 
                                    value="{{ old('store_website', $settings['store_website'] ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Contoh: https://tokosaya.com">
                            </div>

                            <button type="submit" class="primary-btn w-full sm:w-auto">
                                <i class="fas fa-save mr-2"></i> Simpan Informasi Toko
                            </button>
                        </form>
                    </div>
                </div>

                <!-- TAB: TAMPILAN (Appearance Settings) -->
                <div id="section-tampilan" class="hidden space-y-6">
                    <div class="premium-card">
                        <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 pb-4 border-b flex items-center gap-2">
                            <i class="fas fa-palette text-primary-500"></i> Pengaturan Tampilan
                        </h2>

                        <form action="{{ route('settings.update', 'appearance') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Logo -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-image mr-1"></i> Logo Toko
                                </label>
                                <div class="flex items-center gap-4">
                                    @if($settings['logo_path'] ?? null)
                                        <img src="{{ asset('storage/' . $settings['logo_path']) }}" alt="Logo" class="w-20 h-20 object-contain rounded-lg border border-gray-300">
                                    @else
                                        <div class="w-20 h-20 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400">
                                            <i class="fas fa-image text-2xl"></i>
                                        </div>
                                    @endif
                                    <input type="file" name="logo" accept="image/*" class="flex-1">
                                </div>
                            </div>

                            <!-- Theme Colors -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">
                                        <i class="fas fa-paint-brush mr-1"></i> Warna Utama
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" name="primary_color" 
                                            value="{{ old('primary_color', $settings['primary_color'] ?? '#20a770') }}"
                                            class="w-12 h-12 rounded-lg cursor-pointer border border-gray-300">
                                        <input type="text" 
                                            value="{{ old('primary_color', $settings['primary_color'] ?? '#20a770') }}"
                                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                                            readonly>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">
                                        <i class="fas fa-paint-brush mr-1"></i> Warna Sekunder
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <input type="color" name="secondary_color" 
                                            value="{{ old('secondary_color', $settings['secondary_color'] ?? '#0D8ABC') }}"
                                            class="w-12 h-12 rounded-lg cursor-pointer border border-gray-300">
                                        <input type="text" 
                                            value="{{ old('secondary_color', $settings['secondary_color'] ?? '#0D8ABC') }}"
                                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="primary-btn w-full sm:w-auto">
                                <i class="fas fa-save mr-2"></i> Simpan Pengaturan Tampilan
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Hide all sections
            document.getElementById('section-toko').style.display = 'none';
            document.getElementById('section-tampilan').style.display = 'none';

            // Update tab styles
            document.querySelectorAll('[id^="tab-"]').forEach(el => {
                el.classList.remove('border-b-2', 'border-primary-500', 'text-primary-600');
                el.classList.add('text-gray-600', 'hover:text-gray-900');
            });

            // Show selected section
            document.getElementById('section-' + tab).style.display = 'block';

            // Update tab style
            document.getElementById('tab-' + tab).classList.remove('text-gray-600', 'hover:text-gray-900');
            document.getElementById('tab-' + tab).classList.add('border-b-2', 'border-primary-500', 'text-primary-600');
        }
    </script>
</x-app-layout>
