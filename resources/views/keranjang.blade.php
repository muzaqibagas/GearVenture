@extends('layout.app')

@section('title', 'Keranjang Belanja')

@push('style')
@endpush

@section('main')
<section class="catalog py-5 d-flex flex-column align-items-center">
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>
    <form action="{{ route('checkout') }}" method="GET">
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
                                <td><input type="checkbox" class="checkbox-produk" data-total="{{ intval($totalItem) }}" name="item_ids[]" value="{{ $item->id }}"></td>
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
                                    @if (!empty($item->keranjang->tanggal_mulai) && !empty($item->keranjang->tanggal_selesai))
                                        {{ \Carbon\Carbon::parse($item->keranjang->tanggal_mulai)->format('d-m-Y') }} <br>
                                        <strong>s/d</strong> <br>
                                        {{ \Carbon\Carbon::parse($item->keranjang->tanggal_selesai)->format('d-m-Y') }}
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
                                <td class="text-total-item" data-id="{{ $item->id }}">
                                    Rp {{ number_format($totalItem, 0, ',', '.') }}
                                    <br><small class="text-muted">(Termasuk tambahan Rp {{ number_format($totalLayanan, 0, ',', '.') }})</small>
                                </td>
                                <td>
                                    <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                        @csrf
                                        @method('DELETE')
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
                    <input type="hidden" id="item-ids-input" name="item_ids_hidden">                                       
                    <button class="btn text-white rounded-pill ms-3" style="background-color:#383d1f">Buat Pesanan</button>
                </span>                    
            </div>
        </div>   
    </form> 
</section>

@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.checkbox-produk');
        const totalTerpilih = document.getElementById('jumlah-terpilih');
        const totalHarga = document.getElementById('total-terpilih');
        const itemIdsInput = document.getElementById('item-ids-input');
        
        // Fungsi untuk format harga menjadi format Rupiah
        function formatRupiah(angka) {
            return 'Rp. ' + angka.toLocaleString('id-ID');
        }

        // Fungsi untuk menghitung total harga dan jumlah produk yang dipilih
        function hitungTotal() {
            let total = 0;
            let jumlah = 0;
            let selectedItems = [];

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    selectedItems.push(checkbox.value);
                    const nilai = parseInt(checkbox.dataset.total) || 0; // Mengambil nilai harga
                    if (!isNaN(nilai)) {
                        total += nilai;
                        jumlah++;
                    }
                }
            });

            // Update jumlah produk yang dipilih dan total harga
            totalTerpilih.innerText = jumlah;
            totalHarga.innerText = formatRupiah(total);

            // Update input hidden untuk item_ids
            itemIdsInput.value = selectedItems.join(',');
        }

        // Event listener untuk setiap checkbox produk
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', hitungTotal);
        });

        // Event listener untuk checkbox "semua produk"
        const semuaCheckbox = document.getElementById('semua-produk');
        if (semuaCheckbox) {
            semuaCheckbox.addEventListener('change', function () {
                const semuaCek = this.checked;
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = semuaCek;
                });
                hitungTotal(); // Panggil hitungTotal setelah mengubah checkbox
            });
        }

        // Panggil hitungTotal ketika halaman dimuat pertama kali untuk memastikan total sudah dihitung
        hitungTotal();
    });    
</script>
@endpush