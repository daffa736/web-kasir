<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo / Nama App -->
                <div class="shrink-0 flex items-center fw-bold fs-5">
                    <a href="{{ route('dashboard') }}" class="font-bold text-lg text-gray-800">
                         Kasir App
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Link Dashboard
                    <x-nav-link :href="url('/dashboard')" :active="request()->is('dashboard*')">
                        {{ __('Dashboard') }}
                    </x-nav-link> -->

                    <!-- Link Transaksi Baru -->
                    <x-nav-link :href="url('/transaksi')" :active="request()->is('transaksi') && !request()->is('transaksi/riwayat*')">
                        {{ __('Kasir') }}
                    </x-nav-link>

                    <!-- Link Riwayat Transaksi (Fitur No. 2) -->
                    <x-nav-link :href="url('/transaksi/riwayat')" :active="request()->is('transaksi/riwayat*')">
                        {{ __('Riwayat Transaksi') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                    <!-- Link Data Produk -->
                    <x-nav-link :href="url('/produk')" :active="request()->is('produk*')">
                        {{ __('Data Produk') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

             <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <!-- NAMA USER SEMENTARA / DARI AUTH -->
                            <div>{{ Auth::user()->name ?? 'Kasir' }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                      
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-red-600 font-semibold">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>