<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-64">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>
     <div class="overflow-x-auto mt-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="py-3 px-4">Kode Transaksi</th>
                            <th class="py-3 px-4">Total Harga</th>
                            <th class="py-3 px-4">Bayar</th>
                            <th class="py-3 px-4">Kembalian</th>
                            <th class="py-3 px-4">Waktu</th>
                            <th class="py-3 px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @forelse($transaksi as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 font-mono text-gray-600">{{ $item->kode_transaksi }}</td>
                            <td class="py-3 px-4 font-mono text-gray-600">Rp  {{  number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 font-mono text-green-600">Rp{{  number_format($item->bayar, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 font-semibold text-red-600">Rp {{ number_format($item->kembalian, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-3 px-4 text-gray-500"><a href="{{ route('transaksi.struk', $item->id) }}" class="border border-collapse-white bg-black text-white p-2 rounded-md">cetak</a></td>

                        </tr>
                        @empty
                        <tr> 
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada transaksi hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    <div class="flex justify-center ">
        {{ $transaksi->links() }}
    </div>
</x-app-layout>