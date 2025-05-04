@extends('layout.app')

@section('title', 'Keranjang Belanja')

@push('style')
@endpush

@section('main')
<section class="catalog py-5 d-flex flex-column align-items-center">
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>

    <!-- Container card -->
    <div class="card shadow-sm rounded-3 border-0 p-3" style="width:100%;">
        <!-- Header tabel -->
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light text-center">
                    <tr>
                        <th></th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Durasi</th>
                        <th>Jam Pengambilan</th> 
                        <th>Layanan Tambahan</th> 
                        <th>Kuantitas</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @if ($items->count())
                    @foreach ($items as $item)  
                        @php
                            $tanggalMulai = \Carbon\Carbon::parse($keranjang->first()->tanggal_mulai);
                            $tanggalSelesai = \Carbon\Carbon::parse($keranjang->first()->tanggal_selesai);
                            $durasiHari = $tanggalMulai->diffInDays($tanggalSelesai) ?: 1;

                            $hargaSatuan = $item->produk->harga_sewa ?? 0;
                            $diskon = $item->produk->konten->diskon ?? 0;
                            $hargaSetelahDiskon = $hargaSatuan * (100 - $diskon) / 100;

                            $subtotalProduk = $hargaSetelahDiskon * $item->jumlah * $durasiHari;
                            $totalLayanan = $item->total_layanan ?? 0;
                            $totalItem = $subtotalProduk + $totalLayanan;
                        @endphp
                                                           
                        @php
                            $total_produk = $item->jumlah * $item->harga;
                            $total_layanan = $item->total_layanan ?? 0;

                            $fotoPertama = $item->produk->fotoBarangs->first();
                            $fotoProduk = $fotoPertama ? $fotoPertama->foto : 'default.jpg';

                            $totalProdukFix = ($total_produk + $total_layanan) ?? 0;
                        @endphp
                        <tr>
                            <td><input type="checkbox" class="checkbox-produk" data-total="{{ intval($totalProdukFix) }}"></td>
                            <td class="text-start">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('pict/' . $fotoProduk ) }}" class="me-3 rounded" width="70" height="70" alt="Produk">
                                    <span>{{ $item->produk->nama }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $hargaAsli = $item->produk->harga_sewa ?? 0;
                                    $diskon = $item->produk->konten->diskon ?? 0;
                                    $hargaSetelahDiskon = $hargaAsli * (100 - $diskon) / 100;
                                @endphp

                                @if($diskon > 0)                                    
                                    <strong>
                                        Rp {{ number_format($hargaSetelahDiskon, 0, ',', '.') }}
                                    </strong>
                                @else
                                    <strong>
                                        Rp {{ number_format($hargaAsli, 0, ',', '.') }}
                                    </strong>
                                @endif
                            </td>
                            <td>
                                @if (!empty($keranjang->tanggal_mulai) && !empty($keranjang->tanggal_selesai))
                                    {{ \Carbon\Carbon::parse($keranjang->tanggal_mulai)->format('d-m-Y') }} <br>
                                    <strong>s/d</strong> <br>
                                    {{ \Carbon\Carbon::parse($keranjang->tanggal_selesai)->format('d-m-Y') }}
                                @else
                                    <span class="text-muted">Tanggal tidak tersedia</span>
                                @endif
                            </td>
                            <td>09.00 - 18.00</td> 
                            <td>
                                @if (!empty($item->tambahan))
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle text-white" style="background-color:#abc337" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Detail Layanan ({{ count($item->tambahan) }})
                                        </button>
                                        <ul class="dropdown-menu p-2" style="min-width: 250px; max-height: 200px; overflow-y: auto;">
                                            @php
                                                $harga_layanan = [
                                                    // Layanan Tambahan
                                                    'meja_lipat' => 10000,
                                                    'kursi_lipat' => 5000,
                                                    'hammock' => 20000,
                                                    // Pencahayaan
                                                    'lampu_led' => 8000,
                                                    'senter_kepala' => 6000,
                                                    'lentera_gantung' => 7000,
                                                    // Perlindungan
                                                    'flysheet' => 15000,
                                                    'ground_sheet' => 10000,
                                                    'terpal' => 12000,
                                                ];
                                            @endphp

                                            @foreach ($item->tambahan as $key => $val)
                                                @php
                                                    $nama = ucwords(str_replace('_', ' ', $key));
                                                    $qty = $item->qty_tambahan[$key] ?? 0;
                                                    $harga = $harga_layanan[$key] ?? 0;
                                                    $subtotal = $qty * $harga;
                                                @endphp
                                                <li class="mb-1">
                                                    <strong>{{ $nama }}</strong><br>
                                                    {{ $qty }} x Rp{{ number_format($harga, 0, ',', '.') }} = 
                                                    <strong>Rp{{ number_format($subtotal, 0, ',', '.') }}</strong>
                                                </li>
                                                <hr class="my-1">
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->jumlah }}</td>
                            <td>
                                Rp {{ number_format($totalItem, 0, ',', '.') }}
                                <br><small class="text-muted">(Termasuk tambahan Rp {{ number_format($totalLayanan, 0, ',', '.') }})</small>
                            </td>
                            <td>
                                <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>                    
                    @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">Keranjang kosong.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center p-3 border-top bg-white">
            <div>
                <input type="checkbox" id="semua-produk">
                <label for="semua-produk">Semua Produk</label>
            </div>
            @php
                $total_semua = 0;
            @endphp

            @foreach ($keranjang as $keranjangItem)
                @foreach ($keranjangItem->items as $item)
                    @php
                        $total_produk = $item->jumlah * $item->harga;
                        $total_layanan = $item->total_layanan ?? 0;
                        $total_semua += $total_produk + $total_layanan;
                    @endphp
                @endforeach
            @endforeach




            <span class="me-3">
                Total terpilih (<span id="jumlah-terpilih">0</span> produk): 
                <strong id="total-terpilih">Rp. 0</strong>
                <a href="{{ route ('checkout')}}" class="btn text-white rounded-pill ms-3" style="background-color:#383d1f">Buat Pesanan</a>                
            </span>
        </div>
    </div>
</section>

@endsection

@push('script')
<script>
    function formatRupiah(angka) {
        return 'Rp. ' + angka.toLocaleString('id-ID');
    }

    function hitungTotal() {
    let total = 0;
    let jumlah = 0;

    document.querySelectorAll('.checkbox-produk').forEach(checkbox => {
        if (checkbox.checked) {
            const nilai = parseInt(checkbox.dataset.total);
            console.log("Nilai checkbox:", nilai); // Debugging line
            if (!isNaN(nilai)) {
                total += nilai;
                jumlah++;
            }
        }
    });

    document.getElementById('total-terpilih').textContent = formatRupiah(total);
    document.getElementById('jumlah-terpilih').textContent = jumlah;
}


    // Event listener untuk semua checkbox produk
    document.querySelectorAll('.checkbox-produk').forEach(checkbox => {
        checkbox.addEventListener('change', hitungTotal);
    });

    // Event listener untuk checkbox "semua produk"
    document.getElementById('semua-produk').addEventListener('change', function () {
    const semuaCek = this.checked;
    document.querySelectorAll('.checkbox-produk').forEach(checkbox => {
        checkbox.checked = semuaCek;
    });
    hitungTotal(); // Jangan lupa panggil hitungTotal setelah mengubah checkbox
    });

    if (checkbox.checked) {
    const nilai = parseInt(checkbox.dataset.total) || 0;
    console.log("Terpilih:", nilai);
    total += nilai;
    jumlah++;
    }

</script>
@endpush
