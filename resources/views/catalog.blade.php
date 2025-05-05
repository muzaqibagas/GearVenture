@extends('layout.app')

@section('title', 'Katalog')

@push('style')
<link rel="stylesheet" href="{{ asset ('css/background.css')}}?v=1">
@endpush

@section('main')
<section class="catalog py-4">
    <div class="row">
        <!-- Banner Utama Kiri -->
        <div class="col-md-7">
            <div class="banner border-custom">
                <img src="{{ asset('img/banner.png') }}" alt="Camping Easy Peasy" class="img-fluid">
            </div>
        </div>

        <!-- Banner Kanan (2 Banner Kecil) -->
        <div class="col-md-5 d-flex flex-column justify-content-between">
            <div class="banner-small border-custom">
                <img src="{{ asset('img/banner.png') }}" alt="Side Banner 1" class="img-fluid">
            </div>
            <div class="banner-small border-custom">
                <img src="{{ asset('img/banner.png') }}" alt="Side Banner 2" class="img-fluid">
            </div>
        </div>
    </div> 
</section>

<section class="catalog pb-4">
    <div class="row">    
        <!-- Main Content -->
        <div class="col-md-9">
            <div class="text-white p-3 rounded d-flex justify-content-between align-items-center mb-4" style="background-color:#383d1f">
                <div class="d-flex justify-content-start gap-3">                    
                    <div class="kategori">
                        <select class="form-select" aria-label="Pilih Kategori" onchange="window.location.href=this.value">
                            <option value="{{ route('catalog') }}" {{ !isset($selectedKategori) ? 'selected' : '' }}>Semua Kategori</option>
                            
                            @foreach ($kategori as $kat)  
                                <option value="{{ route('catalog.kategori', ['nama' => $kat->nama]) }}" 
                                    {{ isset($selectedKategori) && $selectedKategori == $kat->nama ? 'selected' : '' }}>
                                    {{ $kat->nama ?? 'Tidak ada kategori' }}
                                </option>                     
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    @if ($data->currentPage() > 1)
                        <a href="{{ $data->previousPageUrl() }}" class="btn btn-light">...</a>
                    @endif

                    @for ($page = 1; $page <= $data->lastPage(); $page++)
                        <a href="{{ $data->url($page) }}" class="btn btn-light {{ $page == $data->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endfor

                    @if ($data->hasMorePages())
                        <a href="{{ $data->nextPageUrl() }}" class="btn btn-light">...</a>
                    @endif
                </div>
            </div>       
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
     
            <div class="row g-3">                
            @foreach ($data as $dabar)  
                <div class="col-md-4 p-1">
                    <div class="card">
                        @if ($dabar->fotoBarangs->count() > 0)
                            <img src="{{ asset('pict/'.$dabar->fotoBarangs->first()->foto) }}" class="card-img-top" alt="{{ $dabar->nama }}">
                        @else
                            <img src="{{ asset('pict/default-image.jpg') }}" class="card-img-top" alt="No Image">
                        @endif                        
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">{{$dabar->nama}}</p>
                            <p class="fw-bold" style="color:#c3d234">
                                @php
                                    // Ambil harga sewa dan diskon
                                    $diskon = $dabar->konten->diskon ?? 0;
                                    $hargaDiskon = $dabar->harga_sewa * (100 - $diskon) / 100;
                                @endphp

                                @if($diskon > 0)
                                    <span class="text-decoration-line-through text-danger">
                                        Rp {{ number_format($dabar->harga_sewa, 0, ',', '.') }}
                                    </span>
                                    Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                                @else
                                    Rp {{ number_format($dabar->harga_sewa, 0, ',', '.') }}
                                @endif
                            </p>
                            <a href="{{ route('detail', $dabar->id) }}" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>                
            @endforeach 
            </div>            
        </div>

        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar p-3 pt-0 shadow-sm bg-white rounded">
                <h5 class="fw-bold pt-3">KATEGORI PRODUK</h5>
                <div class="kategori d-grid gap-2">
                    <a href="{{ route('catalog') }}" class="card px-3 py-2 fw-bold text-decoration-none" style="border: 1px solid #383d1f; 
                            {{ !isset($selectedKategori) ? 'background-color: #383d1f; color: white;' : '' }}">
                        <span>Semua Kategori</span>
                    </a>

                @foreach ($kategori as $kat)  
                    <a href="{{ route('catalog.kategori', ['nama' => $kat->nama]) }}" class="card px-3 py-2 fw-bold text-decoration-none" style="border: 1px solid #383d1f; 
                            {{ isset($selectedKategori) && $selectedKategori == $kat->nama ? 'background-color: #383d1f; color: white;' : '' }}">
                        <span>{{ $kat->nama ?? 'Tidak ada kategori' }}</span>                        
                    </a>                     
                @endforeach
                </div>            

                <h5 class="fw-bold mt-5">PRODUK DISKON</h5>
                <ul class="list-group list-group-flush"> 
                @foreach ($dakon as $dabar)                    
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <a href="{{ route('detail', $dabar->id) }}" class="mb-0 text-decoration-none text-dark">{{$dabar->nama}}</a>
                            <div class="discount" style="color:#c3d234">Up to {{ $dabar->konten->diskon ?? 'Tidak ada diskon' }}%</div>                          
                            <small class="fw-bold" style="color:#c3d234"><s class="text-secondary">{{$dabar->harga_sewa}}</s>
                                @php                                    
                                    $hargaDiskon = $dabar->harga_sewa * (100 - ($dabar->konten->diskon ?? 0)) / 100;
                                @endphp
                                {{ number_format($hargaDiskon, 0, ',', '.') }}
                            </small>
                        </div>
                        @if ($dabar->fotoBarangs->count() > 0)
                            <img src="{{ asset('pict/'.$dabar->fotoBarangs->first()->foto) }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px" alt="{{ $dabar->nama }}">
                        @else
                            <img src="{{ asset('pict/default-image.jpg') }}" class="card-img-top" alt="No Image">
                        @endif                             
                    </li>
                @endforeach                                      
                </ul>

                <h5 class="fw-bold mt-5">PRODUK UNGGULAN</h5>
                <ul class="list-group list-group-flush">                    
                @foreach($dakat as $item)
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <a href="{{ route('detail', $item->produk->id) }}" class="mb-0 text-decoration-none text-dark">{{ $item->produk->nama ?? 'Nama tidak tersedia' }}</a>   </br>                                                  
                            <small class="fw-bold" style="color:#c3d234">{{ $item->produk->harga_sewa ?? 'Harga tidak tersedia' }}</small>
                            <div class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $item->Rating)
                                    <i class="fas fa-star text-yellow-400"></i> <!-- bintang penuh -->
                                @else
                                    <i class="far fa-star text-yellow-400"></i> <!-- bintang kosong -->
                                @endif
                                @endfor                        
                            </div>
                        </div>
                        @if ($dabar->fotoBarangs->count() > 0)
                            <img src="{{ asset('pict/'.$dabar->fotoBarangs->first()->foto) }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px" alt="{{ $dabar->nama }}">
                        @else
                            <img src="{{ asset('pict/default-image.jpg') }}" class="card-img-top" alt="No Image">
                        @endif                          
                    </li>
                @endforeach                                          
                </ul>
            </div>
        </div>
       
    </div>
</section>  

@endsection

@push('script')
@endpush