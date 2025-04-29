@extends('layout.app')

@section('title', 'Home')

@push('style')
<link rel="stylesheet" href="{{ asset ('css/background.css')}}?v=1">
@endpush

@section('main')

<section class="catalog py-4"> 
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>
    <div class="row mt-3 d-flex justify-content-center gap-3">
        <div class="col-lg-4">
            <img src="{{ asset('pict/'.$data->foto)}}" class="rounded" style="width:100%; height:400px" alt="Tenda Camping">
            <div class="mt-3 d-flex thumbnail-container gap-3">
                <img src="{{ asset('img/banner-02.jpg') }}" class="rounded" style="width:80px; height:80px" alt="Thumbnail">                
                <img src="{{ asset('img/banner-02.jpg') }}" class="rounded" style="width:80px; height:80px" alt="Thumbnail">                
                <img src="{{ asset('img/banner-02.jpg') }}" class="rounded" style="width:80px; height:80px" alt="Thumbnail">                
                <img src="{{ asset('img/banner-02.jpg') }}" class="rounded" style="width:80px; height:80px" alt="Thumbnail">                
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
                <div class="col-6 mb-4">
                    <img src="{{ asset('img/banner-02.jpg') }}" class="rounded w-100" alt="Produk 1" style="height:200px; object-fit:cover;">
                    <p class="mb-0">Aouto-Pop Camping Tent</p>
                    <p class="mb-0 fw-bold" style="color:#c3d234">Rp125.000</p>
                </div>
                <div class="col-6 mb-4">
                    <img src="{{ asset('img/banner-02.jpg') }}" class="rounded w-100" alt="Produk 2" style="height:200px; object-fit:cover;">
                    <p class="mb-0">Aouto-Pop Camping Tent</p>
                    <p class="mb-0 fw-bold" style="color:#c3d234">Rp125.000</p>
                </div>
                <div class="col-6 mb-4">
                    <img src="{{ asset('img/banner-02.jpg') }}" class="rounded w-100" alt="Produk 3" style="height:200px; object-fit:cover;">
                    <p class="mb-0">Aouto-Pop Camping Tent</p>
                    <p class="mb-0 fw-bold" style="color:#c3d234">Rp125.000</p>
                </div>
                <div class="col-6 mb-4">
                    <img src="{{ asset('img/banner-02.jpg') }}" class="rounded w-100" alt="Produk 4" style="height:200px; object-fit:cover;">
                    <p class="mb-0">Aouto-Pop Camping Tent</p>
                    <p class="mb-0 fw-bold" style="color:#c3d234">Rp125.000</p>
                </div>
            </div>
        </div>    
        <div class="col-lg-4 product-container">
            <h3>{{$data->nama}}</h3>            
            <p class="price" style="color:#929c3b">                
                @php
                    // Periksa apakah ada diskon
                    $hargaDiskon = $data->harga_sewa * (100 - ($data->konten->diskon ?? 0)) / 100;
                @endphp
                <!-- Jika ada diskon, tampilkan harga setelah diskon -->
                @if($data->konten && $data->konten->diskon > 0)
                    <span class="text-decoration-line-through text-danger">Rp {{ number_format($data->harga_sewa, 0, ',', '.') }}</span>
                    Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                @else
                    <!-- Jika tidak ada diskon, tampilkan harga biasa -->
                    Rp {{ number_format($data->harga_sewa, 0, ',', '.') }}
                @endif
            </p>
            <p class="border-2 border-bottom border-dark pb-1 mb-2"><strong>Ketersediaan:</strong> <span class="fw-bold" style="color:#c3d234">Tersedia</span></p>            
            <p class="text-justify">{{$data->deskripsi}}</p>
            <div class="d-flex justify-content-between">
                <p class="border-2 border-bottom border-dark border-top"><strong>Jam diambil:</strong> 09.00 WIB</p>
                <p class="border-2 border-bottom border-dark border-top"><strong>Jam kembali:</strong> 18.00 WIB</p>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                <label for="tanggal">Tanggal mulai:</label>
                <input type="date" id="tanggal" class="form-control mb-3" style="width: 180px;">
                </div>
                <div>
                <label for="tanggal">Tanggal selesai:</label>
                <input type="date" id="tanggal" class="form-control mb-3" style="width: 180px;">
                </div>
            </div>
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" class="form-control mb-3" value="0">
            <h5>Layanan Tambahan</h5>            
            <div class="card p-3">
                <div class="mb-3">
                    <h6>Kenyamanan Tambahan</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Meja Lipat</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>                
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Kursi Lipat</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Hammock</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>  
                </div>                            
                <div class="mb-3">
                    <h6>Kenyamanan Tambahan</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Meja Lipat</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>                
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Kursi Lipat</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Hammock</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>  
                </div>  
                                          
                <div class="mb-3">
                    <h6>Kenyamanan Tambahan</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Meja Lipat</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>                
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Kursi Lipat</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="meja">
                            <label class="form-check-label" for="meja">Hammock</label>
                        </div>
                        <input type="number" class="form-control" placeholder="0" style="width: 150px;">
                    </div>  
                </div>  
                                          
            </div>
            <button class="btn mt-3 w-100" style="background-color:#383d1f; color:white">Masukkan Keranjang</button>
        </div>
    </div>    
</section>

@endsection

@push('script')
@endpush