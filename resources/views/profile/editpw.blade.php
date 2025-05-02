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
                    <div class="fw-semibold border-bottom pb-3">Hi, {{ Auth::guard('web')->user()->username }}</div>
                </div>

                <h6 class="text-uppercase text-xs font-weight-bolder opacity-6 text-secondary">Info Akun</h6>
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="{{ route ('profileuser')}}">
                            <div class="shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="iconamoon--profile-fill"></span>
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
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark" href="{{ route ('hapusakun')}}">
                            <div class="shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="mdi--trash-can-empty bg-dark"></span>
                            </div>
                            <span class="nav-link-text ms-1">Hapus Akun</span>
                        </a>
                    </li>                                            
                </ul>                                                
                <ul class="nav nav-pills nav-fill">                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 bg-white text-decoration-none text-dark shadow" href="{{ route ('editpw') }}">
                            <div class="anjing active shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="mdi--password green"></span>
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
            </div>
        </aside>
        
        <div class="d-flex align-items-center py-4" style="width:80%">
            <div class="row justify-content-center ">
                <form action="{{ route('updatepw') }}" class="col-8 d-flex justify-content-center" method="POST">
                    @csrf
                    <div class="card w-70 mb-4 p-4">
                        <div class="row align-items-center">
                            @if (session('success'))
                                <div class="alert alert-success text-white">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger text-white">
                                    {{ session('error') }}
                                </div>
                            @endif

                            {{-- Menampilkan error validasi jika ada --}}
                            @if ($errors->any())
                                <div class="alert alert-danger text-white">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif  
                            <h4 class="mb-3 px-4">Ubah Password</h4>

                            <!-- Informasi Profil -->
                            <div class="col-md-9 w-100">                            
                                <div class="row justify-content-center gap-1">
                                    <div class="mb-3 d-flex align-items-center px-4">
                                        <div class="col-5 fw-bold rounded me-3 d-flex align-items-center" style="color:#abc337; height:30px">Password Saat Ini</div>:
                                        <input type="password" name="current_password" class="col-7 border rounded w-50 d-flex align-items-center ms-1">
                                    </div>
                                    <div class="mb-3 d-flex align-items-center px-4">
                                        <div class="col-5 fw-bold rounded me-3 d-flex align-items-center" style="color:#abc337; height:30px">password Baru</div>:
                                        <input type="password" name="new_password" class="col-7 border rounded w-50 d-flex align-items-center ms-1">
                                    </div>
                                    <div class="mb-3 d-flex align-items-center px-4">
                                        <div class="col-5 fw-bold rounded me-3 d-flex align-items-center" style="color:#abc337; height:30px">Konfirmasi Password Baru</div>:
                                        <input type="password" name="new_password_confirmation" class="col-7 border rounded w-50 d-flex align-items-center ms-1">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Tombol Hapus Akun -->
                        <div class="text-center mt-4 d-flex justify-content-end align-items-center me-3" >
                            <button class="btn btn-danger rounded-pill px-4 py-2 d-flex align-items-center" style="height:30px">Ganti Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
@endpush