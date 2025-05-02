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
                        <a class="d-flex align-items-center rounded p-2 bg-white text-decoration-none text-dark shadow" href="{{ route ('edituser')}}">
                            <div class="anjing active shadow border-radius-md rounded text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="pen fa6-solid--pen green"></span>
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
            </div>
        </aside>
        
        <div class="d-flex align-items-center py-4" style="width:80%">
            <div class="row justify-content-center">
                <div class="col-8 d-flex justify-content-center flex-column">
                    <form action="{{ route('updateuser') }}" method="POST" enctype="multipart/form-data" class="w-100">
                        @csrf
                        <div class="card w-100 mb-4 p-4">
                            @if (session('sukses'))
                                <div class="alert alert-success">
                                    {{ session('sukses') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger text-white">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row align-items-center">
                                <h4 class="mb-3 px-4">Profil Saya</h4>

                                <!-- Foto Profil -->
                                <div class="col-md-3 text-center position-relative">
                                    <label for="fotoInput" style="cursor: pointer; position: relative; display: inline-block;">
                                        <img src="{{ Auth::guard('web')->user()->foto ? asset('foto/user/' . Auth::guard('web')->user()->foto) : asset('foto/user/default.jpg') }}" alt="Foto Profil" class="rounded-circle img-fluid" style="width: 120px; height: 120px; object-fit: cover;">
                                        <div class="position-absolute start-50 translate-middle text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="background-color: #abc337; margin-left: 1.5rem; width: 36px; height: 36px; box-shadow: 0 2px 5px rgba(0,0,0,0.3); margin-top:-5px;">
                                            <i class="material-symbols--photo-camera"></i>
                                        </div>
                                    </label>
                                    <input type="file" name="foto" id="fotoInput" class="d-none" onchange="previewImage(this)">
                                </div>

                                <!-- Informasi Profil -->
                                <div class="col-md-9">
                                    <div class="row gap-2">
                                        <div class="d-flex w-100">
                                            <div class="col-5 fw-bold border-0" style="color:#abc337;">Username</div>:
                                            <div class="col-7 px-2 ms-1">
                                                <input type="text" name="username" class="form-control" value="{{ Auth::guard('web')->user()->username }}">
                                            </div>
                                        </div>

                                        <div class="d-flex w-100">
                                            <div class="col-5 fw-bold border-0" style="color:#abc337;">Nama</div>:
                                            <div class="col-7 px-2 ms-1">
                                                <input type="text" name="nama" class="form-control" value="{{ Auth::guard('web')->user()->nama }}">
                                            </div>
                                        </div>

                                        <div class="d-flex w-100">
                                            <div class="col-5 fw-bold border-0" style="color:#abc337;">Email</div>:
                                            <div class="col-7 px-2 ms-1">
                                                <input type="text" name="email" class="form-control" value="{{ Auth::guard('web')->user()->email }}">
                                            </div>
                                        </div>                                        
                                        <div class="d-flex w-100 align-items-center">
                                            <div class="col-5 fw-bold border-0" style="color:#abc337;">Jenis Kelamin</div>:
                                            <div class="col-7 px-2 ms-1 d-flex gap-3">
                                                <label class="text-muted fs-6 fw-normal">
                                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ Auth::guard('web')->user()->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}> Laki-laki
                                                </label>
                                                <label class="text-muted fs-6 fw-normal">
                                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ Auth::guard('web')->user()->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}> Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="text-center mt-4 d-flex justify-content-end align-items-center me-3">
                                <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 d-flex align-items-center" style="height:30px">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
<script>
  function previewImage(input) {
      if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
              document.querySelector('img[alt="Foto Profil"]').src = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  </script>
@endpush