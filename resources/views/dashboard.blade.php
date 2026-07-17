<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Kasir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- 1. STATS SECTION (KARTU INFORMASI) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Card 1: Total Produk -->
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Total Produk</div>
                    <!-- BACKEND: Tampilkan jumlah produk dari database -->
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $totalProduk ?? '0' }}</div>
                    <div class="text-xs text-gray-500 mt-1">Produk terdaftar di sistem</div>
                </div>

                <!-- Card 2: Stok Menipis -->
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-red-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Stok Menipis</div>
                    <!-- BACKEND: Tampilkan jumlah produk yang stoknya < 5 -->
                    <div class="mt-2 text-3xl font-bold text-red-600">{{ $stokMenipis ?? '0' }}</div>
                    <div class="text-xs text-red-500 mt-1">Segera lakukan restock!</div>
                </div>

                <!-- Card 3: Transaksi Hari Ini -->
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Transaksi Hari Ini</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">0</div>
                    <div class="text-xs text-gray-500 mt-1">Pesanan selesai diproses</div>
                </div>

                <!-- Card 4: Pendapatan Hari Ini -->
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-amber-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Pendapatan Hari Ini</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">Rp 0</div>
                    <div class="text-xs text-gray-500 mt-1">Total omset kasir</div>
                </div>
            </div>

            <!-- 2. QUICK ACTIONS (AKSI CEPAT) -->
            <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('produk.index') }}" class="inline-flex items-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-semibold transition shadow">
                        📦 Kelola Stok Produk
                    </a>
                    <!-- Tombol ini nanti mengarah ke fitur Transaksi yang akan kita buat -->
                    <a href="#" class="inline-flex items-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm font-semibold transition shadow">
                        🛒 Buka Aplikasi Kasir
                    </a>
                </div>
            </div>

            <!-- 3. RECENT TRANSACTIONS (TRANSAKSI TERBARU) -->
            <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Transaksi Terbaru</h3>
                <div class="text-center py-8 text-gray-500 border-2 border-dashed border-gray-200 rounded-lg">
                    <p class="text-sm">Belum ada transaksi yang tercatat hari ini.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>