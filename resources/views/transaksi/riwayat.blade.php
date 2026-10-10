<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-64">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>
    <div class="overflow-x-auto">
        <table class="table-auto md:table-fixed border-collapse border-spacing-2 border mt-4 mx-auto ">
            <tr>
                <th class="border p-2 border-black bg-gray-700 text-white ">#</th>
                <th class="border p-2  border-black bg-gray-700 text-white ">kode</th>
                <th class="border p-2  border-black  bg-gray-700 text-white ">total</th>
                <th class="border p-2  border-black bg-gray-700 text-white ">bayar</th>
                <th class="border p-2  border-black bg-gray-700 text-white ">kembalian</th>
                <th class="border p-2 border-black  bg-gray-700 text-white ">waktu</th>

            </tr>
            @forelse( $transaksi as $data)
            <tr>
                <td class="border p-2 border-black">{{ $data->id }}</td>
                <td class="border p-2 border-black">{{ $data->kode_transaksi }}</td>
                <td class="border p-2 border-black">Rp{{ number_format($data->total_harga,'0',',','.') }}</td>
                <td class="border p-2 border-black text-green-800">Rp{{ number_format($data->bayar,'0',',','.') }}</td>
                <td class="border p-2 border-black text-red-600">Rp{{ number_format($data->kembalian,'0',',','.') }}</td>
                <td class="border p-2 border-black">{{ $data->created_at }}</td>
            </tr>
            @empty
            <tr>
                <td>data kosong</td>
            </tr>

            @endforelse
        </table>
    </div>
    <div class="flex justify-center ">
        {{ $transaksi->links() }}
    </div>
</x-app-layout>