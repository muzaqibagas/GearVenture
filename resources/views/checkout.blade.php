@extends('layout.appmidtrans')

@section('title', 'Home')

@push('style')
@endpush

@section('main')

<section class="catalog py-5 d-flex flex-column align-items-center">
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>
    <form method="POST" action="" id="checkout-form">
        @csrf
        <div class="card shadow-sm border-0 my-4" style="width:80%">
            <div class="card-body">
                <p class="text-center">
                    Silahkan lengkapi data diri untuk mendapatkan <span class="text-danger fw-bold">kode pesanan</span>
                    agar dapat melanjutkan proses pemesanan
                </p>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="No Handphone" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"  placeholder="Email" required>
                </div>
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

                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="produk_id[]" value="{{ $item->produk->id }}">
                                    <input type="hidden" name="jumlah[]" value="{{ $item->jumlah }}">
                                    <input type="hidden" name="tanggal[]" value="{{ now()->toDateString() }}">
                                    <input type="hidden" name="total_harga[]" value="{{ $totalItem }}">
                                    <input type="hidden" name="durasi[]" value="{{ $durasiHari }}">
                                    <input type="hidden" name="tambahan[]" value='@json($item->tambahan)'>
                                    <input type="hidden" name="qty_tambahan[]" value='@json($item->qty_tambahan)'>


                                    <tr>
                                        <td>{{ $item->produk->nama }}</td>
                                        <td>Rp {{ number_format($hargaSetelahDiskon, 0, ',', '.') }}</td>
                                        <td>{{ $durasiHari }} hari</td>
                                        <td>09.00 - 18.00</td>
                                        <td>Rp {{ number_format($totalLayanan, 0, ',', '.') }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>Rp {{ number_format($totalItem, 0, ',', '.') }}</td>
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
                        <button id="paybutton" class="btn rounded mt-2 text-white" style="background-color:#383d1f" type="submit">Bayar</button>
                    </div>
                </div>
            </div>
        </div>  
    </form> 
</section>


@endsection

@push('script')
<script>
    document.getElementById('paybutton').addEventListener('click', function (e) {
        e.preventDefault();

        const form = document.getElementById('checkout-form');
        const formData = new FormData(form);

        // Hitung total harga dari input hidden
        let total = 0;
        formData.getAll('total_harga[]').forEach(val => {
            total += parseInt(val);
        });

        formData.append('amount', total);

        fetch("{{ url('/place-order') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            console.log(data); // Menampilkan data response untuk debugging
            if (data.token && data.order_id) {
                document.getElementById('id').value = data.order_id;

                window.snap.pay(data.token, {
                    onSuccess: function(result) {
                        console.log(result); // Menampilkan hasil pembayaran sukses
                        form.action = "{{ route('transaksi.store') }}";
                        form.submit();
                    },
                    onPending: function(result) {
                        console.log(result); // Menampilkan hasil pembayaran pending
                        alert("Transaksi sedang diproses. Silakan cek email Anda.");
                    },
                    onError: function(result) {
                        console.error(result); // Menampilkan error jika ada
                        alert("Terjadi kesalahan dalam pembayaran.");
                    },
                    onClose: function() {
                        alert("Anda menutup pembayaran sebelum menyelesaikannya.");
                    }
                });
            } else {
                alert("Gagal mendapatkan token Midtrans.");
            }
        })
    });
</script>
@endpush
