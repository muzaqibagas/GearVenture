@extends('layout.app')

@section('title', 'Detail Produk')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/background.css') }}?v=1">
@endpush

@section('main')

<section class="catalog py-4"> 
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>
    <div class="row mt-3 d-flex justify-content-center gap-3">
        <!-- Kolom Gambar Produk -->
        <div class="col-lg-4">
            @if ($data->fotoBarangs->isNotEmpty())
                <img src="{{ asset('pict/' . $data->fotoBarangs->first()->foto) }}" class="rounded" style="width:100%; height:400px" alt="{{ $data->nama }}">
            @endif
            <div class="mt-3 d-flex thumbnail-container gap-3">
                @foreach ($data->fotoBarangs->skip(1) as $foto)
                    <img src="{{ asset('pict/' . $foto->foto) }}" class="rounded" style="width:80px; height:80px" alt="Thumbnail">                    
                @endforeach
            </div>

            <h5 class="mt-3">Termasuk dalam layanan</h5>
            <ul>
                <li>Kompor Gas Portable (Gratis)</li>
                <li>Matras (Gratis)</li>
                <li>Nesting/Panci (Gratis)</li>
                <li>Sleepingbag (Gratis)</li>
                <li>Selimut (Gratis)</li>
            </ul>

            <h4>Produk Terkait</h4>            
            <div class="row">
                @foreach ($dacak as $dabar)  
                    <div class="col-6 mb-4">
                        <img src="{{ asset('pict/'.$dabar->foto)}}" class="rounded w-100" alt="Produk Terkait" style="height:200px; object-fit:cover;">
                        <p class="mb-0">{{ $dabar->nama }}</p>
                        <p class="mb-0 fw-bold" style="color:#c3d234">Rp {{ number_format($dabar->harga_sewa, 0, ',', '.') }}</p>
                    </div>                                                 
                @endforeach 
            </div>
        </div> 

        <!-- Kolom Detail Produk -->
        <div class="col-lg-4 product-container">
            <h3>{{ $data->nama }}</h3>            
            <p class="price" style="color:#929c3b">
                @php
                    // Periksa apakah ada diskon
                    $hargaDiskon = $data->harga_sewa * (100 - ($data->konten->diskon ?? 0)) / 100;
                @endphp
                @if($data->konten && $data->konten->diskon > 0)
                    <span class="text-decoration-line-through text-danger">Rp {{ number_format($data->harga_sewa, 0, ',', '.') }}</span>
                    Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                @else
                    Rp {{ number_format($data->harga_sewa, 0, ',', '.') }}
                @endif
            </p>
            <p class="border-2 border-bottom border-dark pb-1 mb-2"><strong>Ketersediaan:</strong> <span class="fw-bold" style="color:#c3d234">Tersedia</span></p>
            <p class="text-justify">{{ $data->deskripsi }}</p>

            <div class="d-flex justify-content-between">
                <p class="border-2 border-bottom border-dark border-top"><strong>Jam diambil:</strong> 09.00 WIB</p>
                <p class="border-2 border-bottom border-dark border-top"><strong>Jam kembali:</strong> 18.00 WIB</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="mb-0 list-unstyled text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('keranjang.tambah') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $data->id }}">

                <!-- Tanggal Mulai & Selesai -->
                <div class="d-flex justify-content-between">
                    <div>
                        <label for="tanggal_mulai">Tanggal mulai:</label>
                        <input type="date" name="tanggal_mulai" class="form-control mb-3" style="width: 180px;" required>
                    </div>
                    <div>
                        <label for="tanggal_selesai">Tanggal selesai:</label>
                        <input type="date" name="tanggal_selesai" class="form-control mb-3" style="width: 180px;" required>
                    </div>
                </div>

                <!-- Jumlah -->
                <label for="jumlah">Jumlah:</label>
                <input type="number" name="jumlah" class="form-control mb-3" value="1" min="1" required>

                <!-- Layanan Tambahan -->
                <h5>Layanan Tambahan</h5>
                <div class="card p-3">
                    @php
                        $layananTambahan = ['meja_lipat' => 'Meja Lipat', 'kursi_lipat' => 'Kursi Lipat', 'hammock' => 'Hammock'];
                    @endphp
                    @foreach($layananTambahan as $key => $label)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" name="tambahan[{{ $key }}]">
                            <label class="form-check-label">{{ $label }}</label>
                        </div>
                        <input type="number" name="qty[{{ $key }}]" class="form-control" placeholder="0" style="width: 150px;">
                    </div>
                    @endforeach
                </div>

                <!-- Pencahayaan -->
                <h5>Pencahayaan</h5>
                <div class="card p-3">
                    @php
                        $pencahayaan = ['lampu_led' => 'Lampu LED Portable', 'senter_kepala' => 'Senter Kepala', 'lentera_gantung' => 'Lentera Gantung'];
                    @endphp
                    @foreach($pencahayaan as $key => $label)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" name="tambahan[{{ $key }}]">
                            <label class="form-check-label">{{ $label }}</label>
                        </div>
                        <input type="number" name="qty[{{ $key }}]" class="form-control" placeholder="0" style="width: 150px;">
                    </div>
                    @endforeach
                </div>

                <!-- Perlindungan -->
                <h5>Perlindungan</h5>
                <div class="card p-3">
                    @php
                        $perlindungan = ['flysheet' => 'Flysheet', 'ground_sheet' => 'Ground Sheet', 'terpal' => 'Terpal Anti Air'];
                    @endphp
                    @foreach($perlindungan as $key => $label)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" name="tambahan[{{ $key }}]">
                            <label class="form-check-label">{{ $label }}</label>
                        </div>
                        <input type="number" name="qty[{{ $key }}]" class="form-control" placeholder="0" style="width: 150px;">
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn mt-3 w-100" style="background-color:#383d1f; color:white">Masukkan Keranjang</button>
            </form>
        </div>
    </div>
</section>

@endsection

@push('script')
@endpush
