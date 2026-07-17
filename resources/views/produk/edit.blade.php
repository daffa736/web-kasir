<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ubah Data Produk</h3>
                
                <!-- 
                  [PETUNJUK BACKEND]:
                  1. Isi 'action' dengan Route update kamu, kirimkan ID produknya, contoh: route('produk.update', $product->id)
                  2. Pasang method 'POST'.
                  3. Di bawah tag <form>, WAJIB taruh @csrf dan @method('PUT') (spoofing method).
                -->
                <form action="{{ route('produk.update',$produk->id) }}" method="POST" class="space-y-4">
                    <!-- [PETUNJUK BACKEND]: Taruh @csrf dan @method('PUT') di sini -->
                     @csrf
                     @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <!-- [PETUNJUK BACKEND]: Isi atribut 'value' dengan nama produk lama dari database -->
                        <input type="text" name="produk" value="{{ $produk->produk }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                            <!-- [PETUNJUK BACKEND]: Isi atribut 'value' dengan harga lama -->
                            <input type="number" name="harga" value="{{ $produk->harga }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stok</label>
                            <!-- [PETUNJUK BACKEND]: Isi atribut 'value' dengan stok lama -->
                            <input type="number" name="stok" value="{{ $produk->stok }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('produk.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>