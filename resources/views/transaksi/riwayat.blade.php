<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <!-- Bootstrap 5 CSS biar tampilan rapi & modern -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <div class="container my-5">

        <!-- HEADER HALAMAN -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold m-0"> Riwayat Transaksi</h3>

            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">
                Dashboard
            </a>
        </div>

        <!-- CARD UTAMA -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <!-- TABEL DATA RIWAYAT -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">No. Nota</th>
                                <th scope="col">Tanggal & Waktu</th>
                                <th scope="col" class="text-end">Total Harga</th>
                                <th scope="col" class="text-end">Bayar</th>
                                <th scope="col" class="text-end">Kembali</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- LOOPING DATA DARI CONTROLLER --}}
                            @forelse($transaksi as $index => $item)
                            <tr>
                                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-secondary font-monospace fs-6">
                                        {{ $item->kode_transaksi }}
                                    </span>
                                </td>
                                <td>
                                    <i class="bi bi-clock text-muted me-1"></i>
                                    {{ $item->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-end fw-bold text-success">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="text-end">
                                    Rp {{ number_format($item->bayar, 0, ',', '.') }}
                                </td>
                                <td class="text-end  text-danger">
                                    Rp {{ number_format($item->kembalian, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <!-- TOMBOL CETAK STRUK (Nembak ke cetak struk yang tadi) -->
                                    <button onclick="cetakStruk('{{ $item->id }}')" class="btn btn-sm btn-outline-dark" title="Cetak Struk">
                                        <i class="bi bi-printer-fill"></i> Cetak Struk
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada data transaksi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION (PAGINASI KASUS DATA BANYAK) -->
                <div class="d-flex justify-content-center ">
                    @if(method_exists($transaksi, 'links'))
                    {{ $transaksi->links('pagination::bootstrap-5') }}
                    @endif
                </div>

            </div>
        </div>

    </div>

    <!-- JAVASCRIPT UNTUK BUKA POP-UP STRUK -->
    <script>
        function cetakStruk(id) {
            // Buka halaman struk yang udah kita beresin kemarin di tab baru
            window.open('/transaksi/struk/' + id, '_blank', 'width=400,height=600');
        }
    </script>

</body>

</html>