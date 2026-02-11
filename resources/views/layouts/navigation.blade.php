<nav x-data="{ open: false }"
    class="bg-primary-500 text-white shadow-md sticky top-0 z-50 border-b border-white/10"
    style="background-color:var(--color-primary, #20a770);font-family:'Inter',sans-serif;">

    <div class="w-full mx-auto px-3 sm:px-6">
        <div class="flex justify-between items-center h-16">

            <!-- LEFT - HAMBURGER & LOGO -->
            <div class="flex items-center gap-3 sm:gap-6">

                <!-- MOBILE HAMBURGER - LEFT SIDE -->
                <button @click="open=!open" class="text-white hover:text-white/80 text-xl transition md:hidden">
                    <i :class="open ? 'fas fa-times' : 'fas fa-bars'"></i>
                </button>

                <!-- LOGO -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="font-extrabold text-lg sm:text-xl tracking-tight flex items-center gap-2 text-white">
                        <i class="fas fa-cash-register"></i>
                        <span class="hidden sm:inline">{{ session('settings.store_name', cache()->get("app_settings_store", [])['store_name'] ?? config('app.name', 'Toko Saya')) }}</span>
                    </a>
                </div>

            <!-- MENU DESKTOP -->
                <div class="hidden lg:flex items-center gap-4 font-bold text-xs sm:text-sm ml-6 pl-6 border-l border-white/20">

                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                        <i class="fas fa-chart-line"></i> <span class="hidden xl:inline">Dashboard</span>
                    </a>

                    <a href="{{ route('master') }}"
                        class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                        <i class="fas fa-cube"></i> <span class="hidden xl:inline">Master Data</span>
                    </a>

                    <a href="{{ route('pos.index') }}"
                        class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                        <i class="fas fa-shopping-cart"></i> <span class="hidden xl:inline">Kasir</span>
                    </a>

                    <a href="{{ route('purchases.index') }}"
                        class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                        <i class="fas fa-inbox"></i> <span class="hidden xl:inline">Pembelian</span>
                    </a>

                    <a href="{{ route('returns.index') }}"
                        class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                        <i class="fas fa-undo-alt"></i> <span class="hidden xl:inline">Retur</span>
                    </a>

                    <a href="{{ route('suppliers.index') }}"
                        class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                        <i class="fas fa-building"></i> <span class="hidden xl:inline">Supplier</span>
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                        <i class="fas fa-boxes"></i> <span class="hidden xl:inline">Produk</span>
                    </a>

                    <a href="{{ route('settings.index') }}"
                        class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                        <i class="fas fa-cog"></i> <span class="hidden xl:inline">Pengaturan</span>
                    </a>

                    <!-- DROPDOWN LAPORAN -->
                    <div class="relative" x-data="{open:false}">
                        <button @click="open=!open"
                            class="flex items-center gap-2 hover:text-white/80 transition whitespace-nowrap">
                            <i class="fas fa-file-invoice-dollar"></i> <span class="hidden xl:inline">Laporan</span>
                        </button>

                        <div x-show="open" @click.outside="open=false"
                            class="absolute mt-3 bg-white text-black rounded-xl shadow w-48 py-2 z-10">

                            <a href="{{ route('reports.daily') }}"
                                class="block px-4 py-2 hover:bg-gray-100 text-sm">
                                Laporan Harian
                            </a>

                            <a href="{{ route('reports.monthly') }}"
                                class="block px-4 py-2 hover:bg-gray-100 text-sm">
                                Laporan Bulanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT DESKTOP -->
            <div class="hidden md:flex items-center gap-4 sm:gap-6">

                <div class="flex items-center gap-3 sm:gap-6 border-r border-white/20 pr-3 sm:pr-6">
                    <i class="far fa-bell cursor-pointer hover:text-white/80 transition"></i>
                    <i class="far fa-question-circle cursor-pointer hover:text-white/80 transition"></i>
                </div>

                <!-- USER DESKTOP -->
                <div class="relative" x-data="{open:false}">
                    <button @click="open=!open"
                        class="flex items-center gap-2 sm:gap-3 hover:text-white/80 transition">

                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-[#0D8ABC] flex items-center justify-center text-xs font-black border-2 border-white/20">
                            {{ strtoupper(substr(Auth::user()->name,0,2)) }}
                        </div>

                        <span class="text-xs sm:text-sm font-bold hidden sm:inline">
                            {{ Auth::user()->name }}
                        </span>
                    </button>

                    <div x-show="open" @click.outside="open=false"
                        class="absolute right-0 mt-3 bg-white text-black rounded-xl shadow w-48 py-2 z-10">

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 hover:bg-gray-100 text-sm">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600 text-sm">
                                Logout
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- MOBILE MENU BTN -->
            <div class="flex items-center md:hidden gap-3">
                <!-- Mobile User -->
                <div class="relative" x-data="{open:false}">
                    <button @click="open=!open"
                        class="w-8 h-8 rounded-full bg-[#0D8ABC] flex items-center justify-center text-xs font-black border-2 border-white/20">
                        {{ strtoupper(substr(Auth::user()->name,0,2)) }}
                    </button>

                    <div x-show="open" @click.outside="open=false"
                        class="absolute right-0 mt-3 bg-white text-black rounded-xl shadow w-40 py-2 z-10">

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 hover:bg-gray-100 text-xs sm:text-sm">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600 text-xs sm:text-sm">
                                Logout
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

        <!-- MOBILE DRAWER MENU (LEFT SIDE) -->
        <!-- Overlay -->
        <div x-show="open" @click="open=false" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:leave="transition ease-in duration-200"
            class="fixed inset-0 bg-black/50 md:hidden z-40" style="display: none;"></div>

        <!-- Drawer -->
        <div x-show="open" 
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed left-0 top-16 bottom-0 w-64 bg-primary-600 md:hidden z-50 overflow-y-auto shadow-lg"
            @click.outside="open=false"
            style="display: none;">
            
            <div class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white"
                    @click="open=false">
                    <i class="fas fa-chart-line w-5"></i> Dashboard
                </a>

                <a href="{{ route('master') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white"
                    @click="open=false">
                    <i class="fas fa-cube w-5"></i> Master Data
                </a>

                <a href="{{ route('pos.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white"
                    @click="open=false">
                    <i class="fas fa-shopping-cart w-5"></i> Kasir
                </a>

                <a href="{{ route('purchases.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white"
                    @click="open=false">
                    <i class="fas fa-inbox w-5"></i> Pembelian
                </a>

                <a href="{{ route('returns.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white"
                    @click="open=false">
                    <i class="fas fa-undo-alt w-5"></i> Retur
                </a>

                <a href="{{ route('suppliers.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white"
                    @click="open=false">
                    <i class="fas fa-building w-5"></i> Supplier
                </a>

                <a href="{{ route('products.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white"
                    @click="open=false">
                    <i class="fas fa-boxes w-5"></i> Produk
                </a>

                <a href="{{ route('settings.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white"
                    @click="open=false">
                    <i class="fas fa-cog w-5"></i> Pengaturan
                </a>

                <!-- Mobile Laporan -->
                <div x-data="{laporan:false}" class="border-t border-white/20 mt-2 pt-2">
                    <button @click="laporan=!laporan"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/15 transition text-sm font-medium text-white">
                        <i class="fas fa-file-invoice-dollar w-5"></i> Laporan
                        <i :class="laporan ? 'fas fa-chevron-up ml-auto' : 'fas fa-chevron-down ml-auto'"></i>
                    </button>
                    <div x-show="laporan" class="pl-8 space-y-2 py-2">
                        <a href="{{ route('reports.daily') }}"
                            class="block px-4 py-2 rounded-lg hover:bg-white/15 transition text-xs text-white"
                            @click="open=false">
                            Laporan Harian
                        </a>
                        <a href="{{ route('reports.monthly') }}"
                            class="block px-4 py-2 rounded-lg hover:bg-white/15 transition text-xs text-white"
                            @click="open=false">
                            Laporan Bulanan
                        </a>
                    </div>
                </div>

                <!-- User Profile Section in Drawer -->
                <div class="border-t border-white/20 mt-4 pt-4">
                    <div class="px-4 py-3 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#0D8ABC] flex items-center justify-center text-xs font-black border-2 border-white/20">
                            {{ strtoupper(substr(Auth::user()->name,0,2)) }}
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-bold text-white">{{ Auth::user()->name }}</div>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-white/15 transition text-xs text-white m-2"
                        @click="open=false">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 rounded-lg hover:bg-red-500/20 transition text-xs text-red-300 m-2">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
