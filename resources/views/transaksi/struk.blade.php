<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <!-- <style>
        /* Setup Dasar Kertas Kasir (58mm) */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            /* Font struk klasik */
            width: 58mm;
            padding: 8px;
            margin: 0 auto;
            font-size: 11px;
            color: #000;
            background-color: #fff;
        }

        /* Utility Class */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        /* Garis Pemisah Putus-Putus Khas Struk */
        .line {
            border-bottom: 1px dashed #000;
            margin: 6px 0;
        }

        /* Tabel Detail Barang */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 2px 0;
        }

        /* Hilangkan Tombol saat Kertas di-Print */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                width: 100%;
                padding: 0;
            }
        }

        /* Styling Tombol Aksi Kasir */
        .btn-container {
            margin-top: 15px;
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .btn {
            padding: 5px 10px;
            font-size: 10px;
            border: 1px solid #000;
            background: #eee;
            cursor: pointer;
            font-family: sans-serif;
            border-radius: 3px;
        }

        .btn:hover {
            background: #ccc;
        }
    </style> -->
</head>
<!-- Otomatis buka pop-up Print saat halaman selesai loading -->

<body onload="window.print()">

    <!-- HEADER TOKO -->
    <div class="text-center">
        <h4 style="font-size: 14px; text-transform: uppercase;">KEDAI ABI</h4>
        <p>Jl. Kanu Sae</p>
        <p>Telp: 085*********</p>
    </div>

    <div class="line"></div>

    <!-- INFORMASI TRANSAKSI -->
    <table>
        <tr>
            <td>No Nota</td>
            <td>:</td>
            <td class="text-right bold">{{ $transaksi->kode_transaksi }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td class="text-right">{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- DAFTAR BARANG -->
    <table>
        @foreach($transaksi->detailTransaksi as $detail)
        <!-- Baris 1: Nama Produk -->
        <tr>
            <td colspan="3" class="bold">{{ $detail->produk->produk }}</td>
        </tr>
        <!-- Baris 2: Qty x Harga & Subtotal -->
        <tr>
            <td style="width: 45%;">{{ $detail->qty }} x {{ number_format($detail->produk->harga) }}</td>
            <td style="width: 5%;"></td>
            <td class="text-right" style="width: 50%;">{{ number_format($detail->subtotal) }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <!-- TOTAL & PEMBAYARAN -->
    <table>
        <tr>
            <td class="bold">TOTAL</td>
            <td class="text-right bold">Rp {{ number_format($transaksi->total_harga) }}</td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="text-right">Rp {{ number_format($transaksi->bayar) }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="text-right">Rp {{ number_format($transaksi->kembalian) }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <!-- FOOTER / PESAN -->
    <div class="text-center" style="margin-top: 5px;">
        <p>*** TERIMA KASIH ***</p>
        <p>Barang yang sudah dibeli<br>tidak dapat ditukar/dikembalikan</p>
    </div>

    <!-- TOMBOL AKSI (Hanya muncul di layar, sembunyi pas diprint) -->
    <div class="btn-container no-print">
        <button class="btn" onclick="window.print()"> Cetak Lagi</button>
        <button class="btn" onclick="window.close()"> Tutup</button>
    </div>

</body>

</html>