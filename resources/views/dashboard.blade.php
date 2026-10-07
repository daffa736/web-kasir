<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-64">
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
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $transaksiHariIni ?? '0'}}</div>
                    <div class="text-xs text-gray-500 mt-1">Pesanan selesai diproses</div>
                </div>

                <!-- Card 4: Pendapatan Hari Ini -->
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-amber-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Pendapatan Hari Ini</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">Rp {{ number_format($pendapatanHariIni) ?? '0' }}</div>
                    <div class="text-xs text-gray-500 mt-1">Total omset kasir</div>
                </div>
            </div>

            <!-- 2. QUICK ACTIONS (AKSI CEPAT) -->
            <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 border-l-4 border-s-green-800">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('produk.index') }}" class="inline-flex items-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-semibold transition shadow">
                        Kelola Stok Produk
                    </a>
                    <!-- Tombol ini nanti mengarah ke fitur Transaksi yang akan kita buat -->
                    <a href="{{ route('transaksi.index') }}" class="inline-flex items-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm font-semibold transition shadow">
                        Buka Aplikasi Kasir
                    </a>
                </div>
            </div>


            <h3 class="text-lg font-bold mb-4 text-gray-800"> Transaksi Terbaru Hari ini</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">No. Nota</th>
                            <th class="py-3 px-4">Total Harga</th>
                            <th class="py-3 px-4">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @forelse($transaksiTerbaru as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 font-mono text-gray-600">{{ $item->kode_transaksi }}</td>
                            <td class="py-3 px-4 font-semibold text-green-600">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada transaksi hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>

    </div>
    </div>
</x-app-layout>