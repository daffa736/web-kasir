<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Kasir (POS)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- GRID SYSTEM: Membagi layar jadi Kiri (Input) & Kanan (Keranjang) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- KOLOM KIRI: PILIH PRODUK -->
                <div class="lg:col-span-1">
                    <div class="p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 font-bold">Pilih Produk</h3>

                        <div class="space-y-4">
                            <!-- Dropdown Produk -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <select id="select-produk"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">-- Pilih Produk1 --</option>

                                    @foreach ($produk as $row )
                                    <option value="{{ $row->id }}" data-nama="{{ $row->produk }}"
                                        data-harga="{{ $row->harga }}" data-stok="{{ $row->stok }}">
                                        {{ $row->produk }} (sisa:{{ $row->stok }} | Rp
                                        {{ number_format($row->harga,0, ',',) }})
                                    </option>
                                    @endforeach
                                    <!-- Nanti data produk dari database kita looping di sini -->
                                </select>
                            </div>

                            <!-- Input Jumlah Beli -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah (Qty)</label>
                                <input type="number" id="input-qty" min="1" value="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Tombol Tambah -->
                            <button type="button" id="btn-tambah"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition">
                                Tambah ke Keranjang 🛒
                            </button>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: TABEL KERANJANG & PEMBAYARAN -->
                <div class="lg:col-span-2">
                    <div class="p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 font-bold">Keranjang Belanja</h3>

                        <!-- Tabel List Belanjaan -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 mb-6">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                            Produk</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">
                                            Harga</th>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">
                                            Qty</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">
                                            Subtotal</th>
                                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-table-body" class="divide-y divide-gray-200">
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-500">Keranjang masih kosong.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Form Hitung Uang Bayar -->
                        <div class="border-t pt-6 space-y-4">
                            <div class="flex justify-between items-center text-2xl font-bold text-gray-900">
                                <span>TOTAL BELANJA:</span>
                                <span id="text-total" class="text-blue-600">Rp 0</span>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Uang Bayar (Rp)</label>
                                    <input type="number" id="input-bayar" placeholder="0"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-lg font-semibold">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Uang Kembalian</label>
                                    <div id="text-kembalian" class="mt-2 text-xl font-bold text-gray-800">Rp 0</div>
                                </div>
                            </div>

                            <!-- Tombol Bayar Akhir -->
                            <button type="button" id="btn-proses"
                                class="w-full inline-flex justify-center items-center px-4 py-3 bg-green-600 hover:bg-green-700 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest transition">
                                PROSES TRANSAKSI (BAYAR) 💳
                            </button>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>

<script>
let keranjang = [];

const selectProduk = document.getElementById('select-produk');
const inputQty = document.getElementById('input-qty');
const btnTambah = document.getElementById('btn-tambah');
const cartTableBody = document.getElementById('cart-table-body');
const textTotal = document.getElementById('text-total');
const inputBayar = document.getElementById('input-bayar');
const btnProses = document.getElementById('btn-proses');
const textKembalian = document.getElementById('text-kembalian');

btnTambah.addEventListener('click', function() {
    const produkId = selectProduk.value;

    if (!produkId) {
        alert('Pilihlah minimal satu produk');
    }

    const selectedOption = selectProduk.options[selectProduk.selectedIndex];
    const namaProduk = selectedOption.getAttribute('data-nama');
    const harga = parseInt(selectedOption.getAttribute('data-harga'));
    const stok = parseInt(selectedOption.getAttribute('data-stok'));
    const qty = parseInt(inputQty.value);

    if (qty > stok) {
        alert('sisa stok gacukup ');
    }

    const produkSama = keranjang.find(item => item.id ===  produkId);
    if(produkSama){
    if(produkSama.qyt + qyt > stok){
        alert('p');
        return;
    }
    produkSama.qyt += qyt;
    produkSama.subtotal = qyt * harga;

   } else{ keranjang.push({
            id: produkId,
            produk: namaProduk,
            harga: harga,
            stok: stok,
            qty: qty,
            subtotal: qty * harga
        });
}    

    inputQty.value = 1;

    updateKeranjang();
});
    
    function updateKeranjang() {
        
        cartTableBody.innerHTML = ' ';
        
        keranjang.forEach((item) => {
            cartTableBody.innerHTML += `
    <tr>
        <td class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase" >
        ${item.produk}
        </td>
        <td class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">
        ${item.harga}
        </td>
        <td class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">
        ${item.qty}
        </td>
        <td class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">
        ${item.subtotal}
        </td>
        <td class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">
        </td>
    </tr>
                                    `;
        });
    

        const totalBelanja = keranjang.reduce((total , item) => total += item.subtotal , 0);
        textTotal.innerText = `Rp ${totalBelanja.toLocaleString('id-ID')}`;

       

        inputBayar.addEventListener('input', function(event){

            let uangDiterima = parseInt(event.target.value) || 0;
            let totalBelanja =  keranjang.reduce((total , item) => total += item.subtotal , 0);
            let kembalian = totalBelanja - uangDiterima;

        if(kembalian > 0){
            textKembalian.innerText = "uang kurang";
            textKembalian.style.color = "red";
        }else{
            let positif = Math.abs(kembalian);
            textKembalian.innerText = `${positif.toLocaleString('id-ID')}`;
            textKembalian.style.color = "green";
        }
        })
        

       btnProses.addEventListener('click', function(index){
        keranjang.splice(index,1);
        updateKeranjang();
    })
    }


</script>