
@extends('layout.app')

@section('title', 'Home')

@push('style')
@endpush

@section('main')

<section class="catalog py-5 d-flex flex-column align-items-center">
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>
    <div class="card shadow-sm border-0 my-4" style="width:80%">
        <div class="card-body">
            <p class="text-center">
                Silahkan lengkapi data diri untuk mendapatkan <span class="text-danger fw-bold">kode pesanan</span>
                agar dapat melanjutkan proses pemesanan
            </p>

            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_handphone" class="form-control" placeholder="No Handphone" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"  placeholder="Email" required>
                </div>
            </form>
        </div>
    </div>

    <!-- Card Pesanan -->
    <div class="card shadow-sm border-0" style="width:80%">
        <div class="card-body">
            <h5 class="mb-3">Pesanan dipesan</h5>

            <!-- Tabel Pesanan -->
            <div class="table-responsive">
                <table class="table align-middle">
                <thead class="text-center bg-light">
                    <tr>                        
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
                    @foreach ($keranjangItems as $keranjang)
                        @foreach ($keranjang->items as $item)                        
                            @php
                                $tanggalMulai = \Carbon\Carbon::parse($keranjang->tanggal_mulai);
                                $tanggalSelesai = \Carbon\Carbon::parse($keranjang->tanggal_selesai);
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
                            @endphp
                            <tr>                                
                                <td class="text-start">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('pict/' . $item->produk->foto) }}" class="me-3 rounded" width="70" height="70" alt="Produk">
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
                                @php
                                    $total_produk = $item->jumlah * $item->harga;
                                    $total_layanan = $item->total_layanan ?? 0;
                                @endphp
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
                    @endforeach
                </tbody>
                </table>
            </div>

            <!-- Total -->
            <div class="d-flex justify-content-end mt-4">
                <div class="text-end">                    
                <h5>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h5>
                <button class="btn rounded mt-2 text-white" style="background-color:#383d1f" type="submit">Bayar</button>
                </div>
            </div>
        </div>
    </div>    
</section>


@endsection

@push('script')
@endpush
