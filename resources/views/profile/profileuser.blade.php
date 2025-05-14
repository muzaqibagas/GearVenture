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
                    <img src="{{ Auth::guard('web')->user()->foto ? asset('foto/user/' . Auth::guard('web')->user()->foto) : asset('foto/user/default.jpg') }}" alt="Foto Profil" class="rounded-circle img-fluid" style="width: 120px; height: 120px; object-fit: cover;">
                    <div class="fw-semibold border-bottom pb-3">Hi, {{ Auth::guard('web')->user()->username }}</div>
                </div>

                <h6 class="text-uppercase text-xs font-weight-bolder opacity-6 text-secondary">Info Akun</h6>
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 bg-white text-decoration-none text-dark shadow" href="{{ route ('profileuser')}}">
                            <div class="anjing active shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="iconamoon--profile-fill green"></span>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </li>                                            
                </ul>                                                
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="{{ route ('edituser')}}">
                            <div class="shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="pen fa6-solid--pen bg-dark"></span>
                            </div>
                            <span class="nav-link-text ms-1">Ubah Profile</span>
                        </a>
                    </li>                                            
                </ul>                                                
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="{{ route ('deleteakun')}}">
                            <div class="shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="mdi--trash-can-empty bg-dark"></span>
                            </div>
                            <span class="nav-link-text ms-1">Hapus Akun</span>
                        </a>
                    </li>                                            
                </ul>                                                
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="{{ route ('editpw') }}">
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
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="{{ route ('belum') }}">
                            <div class="shadow border-radius-md rounded bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="fluent--wallet-credit-card-32-filled text-danger"></span>
                            </div>                            
                            <span class="nav-link-text ms-1">Belum Dibayar</span>
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="{{ route ('sewa') }}">
                            <div class="shadow border-radius-md rounded bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                            <span class="mage--clock-fill text-warning"></span>
                            </div>                            
                            <span class="nav-link-text ms-1">Disewa</span>
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="{{ route ('selesai') }}">
                            <div class="shadow border-radius-md rounded bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="mingcute--check-circle-line text-success">
                            </div>                            
                            <span class="nav-link-text ms-1">Selesai</span>
                        </a>
                    </li>                    
                </ul>      
                <div class="sidenav-footer mx-3 ">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn mt-3 text-white w-100" style="background-color:#abc337; font-weight:bold">Logout</button>
                    </form>      
                </div>                            
            </div>
        </aside>
        
        <div class="d-flex align-items-center py-4 justify-content-center" style="width:80%">
            <div class="row justify-content-center ">
                <div class="col-8 d-flex justify-content-center">
                    <div class="card w-70 mb-4 p-4">
                        <div class="row align-items-center">
                            <!-- Foto Profil -->
                            <h4 class="mb-3 px-4">Profil Saya</h4>
                            <div class="col-md-3 text-center position-relative">                                
                            <img src="{{ Auth::guard('web')->user()->foto ? asset('foto/user/' . Auth::guard('web')->user()->foto) : asset('foto/user/default.jpg') }}" alt="Foto Profil" class="rounded-circle img-fluid" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>

                            <!-- Informasi Profil -->
                            <div class="col-md-9">                            
                                <div class="row d-flex align-items-center">
                                    <div class="d-flex w-100">
                                        <p class="col-5 fw-bold" style="color: #ABC337;">Username</p>:
                                        <p class="col-7 border rounded d-flex align-items-center px-2 ms-1">{{ Auth::guard('web')->user()->username }}</p>
                                    </div>
                                    <div class="d-flex w-100">
                                        <p class="col-5 fw-bold" style="color: #ABC337;">Nama</p>:
                                        <p class="col-7 border rounded d-flex align-items-center px-2 ms-1">{{ Auth::guard('web')->user()->nama }}</p>
                                    </div>
                                    <div class="d-flex w-100">
                                        <p class="col-5 fw-bold" style="color: #ABC337;">Email</p>:
                                        <p class="col-7 border rounded d-flex align-items-center px-2 ms-1">{{ Auth::guard('web')->user()->email }}</p>
                                    </div>                                    
                                    <div class="d-flex w-100">
                                        <p class="col-5 fw-bold" style="color: #ABC337;">Jenis Kelamin</p>:
                                        <p class="col-7 border rounded d-flex align-items-center px-2 ms-1">{{ Auth::guard('web')->user()->jenis_kelamin }}</p>
                                    </div>
                                </div>
                            </div>
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