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
                <!-- <div class="col-md-6">
                    <div class="card flex-row align-items-center px-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold">Fireplace starterkit mini</h5>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>                            
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                        <img src="img/banner-01.jpg" class="img-fluid rounded" style="width: 120px; height: 120px;" alt="Fireplace starterkit mini">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card flex-row align-items-center px-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold">Fireplace starterkit mini</h5>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>                            
                            <a href="#" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>                        
                        <img src="img/banner-01.jpg" class="img-fluid rounded" style="width: 120px; height: 120px;" alt="Fireplace starterkit mini">
                    </div>
                </div> -->

                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="Fireplace starterkit mini">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">Fireplace starterkit mini</p>
                            <p class="fw-bold" style="color:#c3d234">Rp95.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="Barbeque Portable mini">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">Barbeque Portable mini</p>
                            <p class="fw-bold" style="color:#c3d234">Rp55.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="AstaGear Camping Tent">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">AstaGear Camping Tent</p>
                            <p class="fw-bold" style="color:#c3d234">Rp135.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="Kalibre Tenda">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">Kalibre Tenda</p>
                            <p class="fw-bold" style="color:#c3d234">Rp115.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="AVTECH - Flysheet 2x3 Meter">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">AVTECH - Flysheet 2x3 Meter</p>
                            <p class="fw-bold" style="color:#c3d234">Rp75.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="Portable Triangle Hammock">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">Portable Triangle Hammock</p>
                            <p class="fw-bold" style="color:#c3d234">Rp55.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="Kalibre Tenda">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">Kalibre Tenda</p>
                            <p class="fw-bold" style="color:#c3d234">Rp115.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="AVTECH - Flysheet 2x3 Meter">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">AVTECH - Flysheet 2x3 Meter</p>
                            <p class="fw-bold" style="color:#c3d234">Rp75.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="card">
                        <img src="img/banner-01.jpg" class="card-img-top" alt="Portable Triangle Hammock">
                        <div class="card-body my-0 mx-1">
                            <p class="fw-bold m-0">Portable Triangle Hammock</p>
                            <p class="fw-bold" style="color:#c3d234">Rp55.000</p>
                            <a href="detail" class="btn fw-bold rounded-pill" style="background-color:#383d1f; color:white">lihat detail!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar p-3 pt-0 shadow-sm bg-white rounded">
                <h5 class="fw-bold">KATEGORI PRODUK</h5>
                <div class="kategori d-grid gap-2">
                    <div class="card px-3 py-2 fw-bold" style="border: 1px solid #383d1f;">
                        <span>Sleeping Gear</span>
                    </div>
                    <div class="card px-3 py-2 fw-bold" style="border: 1px solid #383d1f;">
                        <span>Tenda & Shelter</span>
                    </div>
                    <div class="card px-3 py-2 fw-bold" style="border: 1px solid #383d1f;">
                        <span>Masak & Makan</span>
                    </div>
                    <div class="card px-3 py-2 fw-bold" style="border: 1px solid #383d1f;">
                        <span>Keamanan & Survival</span>
                    </div>
                    <div class="card px-3 py-2 fw-bold" style="border: 1px solid #383d1f;">
                        <span>Aksesoris & Peralatan Tambahan</span>
                    </div>
                    <div class="card px-3 py-2 fw-bold" style="border: 1px solid #383d1f;">
                        <span>Peralatan Hiking & Trekking</span>
                    </div>
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