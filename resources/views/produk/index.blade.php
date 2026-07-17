<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Stok Produk') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- ALERT NOTIFIKASI SUKSES -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                    <span class="font-semibold">Sukses!</span> {{ session('success') }}
                </div>
            @endif

            <!-- GRID SYSTEM: Kiri Form, Kanan Tabel -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- 1. FORM TAMBAH PRODUK BARU -->
                <div class="lg:col-span-1">
                    <div class="p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Produk Baru</h3>
                        
                        <form action="{{ route('produk.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <!-- Menggunakan name="produk" sesuai database kamu -->
                                <input type="text" name="produk" required placeholder="Contoh: Mie Ayam" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('produk')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                <input type="number" name="harga" required placeholder="Contoh: 15000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('harga')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stok Barang</label>
                                <input type="number" name="stok" required placeholder="Contoh: 50" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('stok')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                                ➕ Simpan Produk
                            </button>
                        </form>
                    </div>
                </div>

                <!-- 2. TABEL DAFTAR STOK PRODUK -->
                <div class="lg:col-span-2">
                    <div class="p-6 bg-white shadow sm:rounded-lg overflow-x-auto">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Stok Produk</h3>
                        
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                
                                @forelse ($produk as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                            {{ $product->produk }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $product->stok < 5 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $product->stok }} Pcs
                                            </span>
                                        </td>
                                        
                                        <!-- KOLOM AKSI (EDIT & DELETE) -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center space-x-2">
                                            
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('produk.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                                Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('produk.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->produk }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                            Belum ada produk yang terdaftar. Mulai tambahkan produk di sebelah kiri!
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>