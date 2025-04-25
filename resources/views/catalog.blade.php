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
                <img src="{{ asset('img/banner-02.jpg') }}" alt="Camping Easy Peasy" class="img-fluid">
            </div>
        </div>

        <!-- Banner Kanan (2 Banner Kecil) -->
        <div class="col-md-5 d-flex flex-column justify-content-between">
            <div class="banner-small border-custom">
                <img src="{{ asset('img/banner-02.jpg') }}" alt="Side Banner 1" class="img-fluid">
            </div>
            <div class="banner-small border-custom">
                <img src="{{ asset('img/banner-02.jpg') }}" alt="Side Banner 2" class="img-fluid">
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
                    <select class="form-select w-auto">
                        <option>Pengurutan: Default</option>
                        <option>Harga Termurah</option>
                        <option>Harga Termahal</option>
                    </select>
                    <select class="form-select w-auto">
                        <option>Kategori</option>
                        <option>Sleeping Gear</option>
                        <option>Tenda & Shelter</option>
                    </select>
                </div>
                <div>
                    <button class="btn btn-light">1</button>
                    <button class="btn btn-light">2</button>
                    <button class="btn btn-light">3</button>
                    <button class="btn btn-light">...</button>
                </div>
            </div>            
            <div class="row g-3">                
            @foreach ($data as $dabar)  
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="{{ asset('pict/'.$dabar->foto)}}" class="card-img-top" alt="Fireplace starterkit mini">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">{{$dabar->nama}}</p>
                            <p class="fw-bold" style="color:#c3d234">Rp {{$dabar->harga_sewa}}</p>
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
                <h5 class="fw-bold">KATEGORI PRODUK</h5>
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
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <p class="mb-0">Barbeque Portable Mini</p>                            
                            <small class="fw-bold" style="color:#c3d234"><s class="text-secondary">Rp110.000 </s>Rp235.000</small>
                        </div>
                        <img src="{{ asset('img/banner-02.jpg') }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px">
                    </li>
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <p class="mb-0">Triangle Hammock</p>                            
                            <small class="fw-bold" style="color:#c3d234"><s class="text-secondary">Rp110.000 </s>Rp110.000</small>
                        </div>
                        <img src="{{ asset('img/banner-02.jpg') }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px">
                    </li>
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <p class="mb-0">Asta Gear Camp Tent</p>                        
                            <small class="fw-bold" style="color:#c3d234"><s class="text-secondary">Rp250.000 </s>Rp250.000</small>
                        </div>
                        <img src="{{ asset('img/banner-02.jpg') }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px">
                    </li>                    
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <p class="mb-0">Asta Gear Camp Tent</p>                            
                            <small class="fw-bold" style="color:#c3d234"><s class="text-secondary">Rp250.000 </s>Rp250.000</small>
                        </div>
                        <img src="{{ asset('img/banner-02.jpg') }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px">
                    </li>                    
                </ul>

                <h5 class="fw-bold mt-5">PRODUK UNGGULAN</h5>
                <ul class="list-group list-group-flush">                    
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <p class="mb-0">Barbeque Portable Mini</p>                            
                            <small class="fw-bold" style="color:#c3d234"><s class="text-secondary">Rp110.000 </s>Rp235.000</small>
                        </div>
                        <img src="{{ asset('img/banner-02.jpg') }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px">
                    </li>
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <p class="mb-0">Triangle Hammock</p>                            
                            <small class="fw-bold" style="color:#c3d234"><s class="text-secondary">Rp110.000 </s>Rp110.000</small>
                        </div>
                        <img src="{{ asset('img/banner-02.jpg') }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px">
                    </li>
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <p class="mb-0">Asta Gear Camp Tent</p>                            
                            <small class="fw-bold" style="color:#c3d234"><s class="text-secondary">Rp250.000 </s>Rp250.000</small>
                        </div>
                        <img src="{{ asset('img/banner-02.jpg') }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px">
                    </li>                    
                    <li class="list-group-item d-flex align-items-center position-relative">
                        <div>
                            <p class="mb-0">Asta Gear Camp Tent</p>                            
                            <small class=" fw-bold" style="color:#c3d234"><s class="text-secondary">Rp250.000 </s>Rp250.000</small>
                        </div>
                        <img src="{{ asset('img/banner-02.jpg') }}" class="position-absolute rounded end-0" style="width: 50px; height: 50px">
                    </li>                    
                </ul>
            </div>
        </div>
       
    </div>
</section>  

@endsection

@push('script')
@endpush