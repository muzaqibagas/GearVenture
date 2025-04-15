@extends('layout.app')

@section('title', 'Home')

@push('style')
@endpush

@section('main')

<section class="catalog py-4"> 
    <div class="d-flex">
        <aside class="sidenav navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start rounded p-3 " style="width:230px" id="sidenav-main">
            <div class="sidebar d-flex flex-column text-dark">
                <div class="text-center mb-4">
                    <img src="{{ asset('img/profile.jpg') }}" alt="logo" class="logo mb-2 rounded-circle" style="width:100px; height:100px">
                    <div class="fw-semibold border-bottom pb-3">Hi, Admin</div>
                </div>

                <h6 class="text-uppercase text-xs font-weight-bolder opacity-6 text-secondary">Info Akun</h6>
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 bg-white text-decoration-none text-dark shadow" href="profileuser">
                            <div class="anjing active shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="iconamoon--profile-fill green"></span>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </li>                                            
                </ul>                                                
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="edituser">
                            <div class="shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="pen fa6-solid--pen bg-dark"></span>
                            </div>
                            <span class="nav-link-text ms-1">Ubah Profile</span>
                        </a>
                    </li>                                            
                </ul>                                                
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="hapusakun">
                            <div class="shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="mdi--trash-can-empty bg-dark"></span>
                            </div>
                            <span class="nav-link-text ms-1">Hapus Akun</span>
                        </a>
                    </li>                                            
                </ul>                                                
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="editpw">
                            <div class="shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="mdi--password"></span>
                            </div>
                            <span class="nav-link-text ms-1">Ubah Password</span>
                        </a>
                    </li>                                            
                </ul>                                                

                <h6 class="text-uppercase text-xs font-weight-bolder opacity-6 pt-3 text-secondary">Status Pesanan</h6>
                <ul class="nav nav-pills nav-fill">                                                          
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="belum">
                            <div class="shadow border-radius-md rounded bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="fluent--wallet-credit-card-32-filled text-danger"></span>
                            </div>                            
                            <span class="nav-link-text ms-1">Belum Dibayar</span>
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="sewa">
                            <div class="shadow border-radius-md rounded bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                            <span class="mage--clock-fill text-warning"></span>
                            </div>                            
                            <span class="nav-link-text ms-1">Disewa</span>
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="selesai">
                            <div class="shadow border-radius-md rounded bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="mingcute--check-circle-line text-success">
                            </div>                            
                            <span class="nav-link-text ms-1">Selesai</span>
                        </a>
                    </li>                    
                </ul>                                  
            </div>
        </aside>
        
        <div class="py-4" style="width:80%">
            <div class="d-flex justify-content-center align-items-center">
                <div class="col-8 d-flex justify-content-center">
                    <div class="card w-70 mb-4 p-4 bg-success" style="width: 100%;">
                        <h4>Hapus Akun</h4>
                        <span class="fluent-mdl2--sad"></span>
                        <p>Ingin Menghapus AKun?</p>

                        <!-- Tombol Hapus Akun -->
                        <div class="text-center mt-4 d-flex justify-content-end align-items-center me-3" h>
                            <button class="btn btn-danger rounded-pill px-4 py-2 d-flex  align-items-center" style="height:30px">Hapus Akun</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
@endpush