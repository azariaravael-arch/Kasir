<nav x-data="{ open: false }"
    class="bg-primary-500 text-white shadow-md sticky top-0 z-50 border-b border-white/10"
    style="background-color:#20a770;font-family:'Inter',sans-serif;">

    <div class="w-full mx-auto px-6">
        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center">

                <!-- LOGO -->
                <div class="shrink-0 flex items-center pr-6 mr-6 border-r border-white/20">
                    <a href="{{ route('dashboard') }}"
                        class="font-extrabold text-xl tracking-tight flex items-center gap-2 text-white">
                        <i class="fas fa-cash-register"></i>
                        <span>{{ config('app.name','Laravel') }}</span>
                    </a>
                </div>

                <!-- MENU -->
                <div class="hidden sm:flex items-center gap-6 font-bold text-sm">

                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-2 hover:text-white/80">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>

                    <a href="{{ route('master') }}"
                        class="flex items-center gap-2 hover:text-white/80">
                        <i class="fas fa-cube"></i> Master Data
                    </a>

                    <a href="{{ route('pos.index') }}"
                        class="flex items-center gap-2 hover:text-white/80">
                        <i class="fas fa-shopping-cart"></i> Kasir
                    </a>

                    <a href="{{ route('purchases.index') }}"
                        class="flex items-center gap-2 hover:text-white/80">
                        <i class="fas fa-inbox"></i> Pembelian
                    </a>

                    <a href="{{ route('returns.index') }}"
                        class="flex items-center gap-2 hover:text-white/80">
                        <i class="fas fa-undo-alt"></i> Retur
                    </a>

                    <a href="{{ route('suppliers.index') }}"
                        class="flex items-center gap-2 hover:text-white/80">
                        <i class="fas fa-building"></i> Supplier
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="flex items-center gap-2 hover:text-white/80">
                        <i class="fas fa-boxes"></i> Produk
                    </a>

                    <!-- DROPDOWN LAPORAN -->
                    <div class="relative" x-data="{open:false}">
                        <button @click="open=!open"
                            class="flex items-center gap-2 hover:text-white/80">
                            <i class="fas fa-file-invoice-dollar"></i> Laporan
                        </button>

                        <div x-show="open" @click.outside="open=false"
                            class="absolute mt-3 bg-white text-black rounded-xl shadow w-48 py-2">

                            <a href="{{ route('reports.daily') }}"
                                class="block px-4 py-2 hover:bg-gray-100">
                                Laporan Harian
                            </a>

                            <a href="{{ route('reports.monthly') }}"
                                class="block px-4 py-2 hover:bg-gray-100">
                                Laporan Bulanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="hidden sm:flex items-center gap-6">

                <div class="flex items-center gap-6 border-r border-white/20 pr-6">
                    <i class="far fa-bell cursor-pointer"></i>
                    <i class="far fa-question-circle cursor-pointer"></i>
                </div>

                <!-- USER -->
                <div class="relative" x-data="{open:false}">
                    <button @click="open=!open"
                        class="flex items-center gap-3">

                        <div
                            class="w-10 h-10 rounded-full bg-[#0D8ABC] flex items-center justify-center text-xs font-black border-2 border-white/20">
                            {{ strtoupper(substr(Auth::user()->name,0,2)) }}
                        </div>

                        <span class="text-sm font-bold">
                            {{ Auth::user()->name }}
                        </span>
                    </button>

                    <div x-show="open" @click.outside="open=false"
                        class="absolute right-0 mt-3 bg-white text-black rounded-xl shadow w-48 py-2">

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 hover:bg-gray-100">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                Logout
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- MOBILE BTN -->
            <div class="flex items-center sm:hidden">
                <button @click="open=!open">
                    ☰
                </button>
            </div>

        </div>
    </div>
</nav>
