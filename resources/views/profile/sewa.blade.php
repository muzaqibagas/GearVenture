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
                        <a class="d-flex align-items-center rounded p-2 text-decoration-none text-dark " href="{{ route ('belum') }}">
                            <div class="shadow border-radius-md rounded bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="fluent--wallet-credit-card-32-filled text-danger"></span>
                            </div>                            
                            <span class="nav-link-text ms-1">Belum Dibayar</span>
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="d-flex align-items-center rounded p-2 bg-white text-decoration-none text-dark shadow" href="{{ route ('sewa') }}">
                            <div class="anjing active shadow border-radius-md rounded bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width:30px; height:30px">
                                <span class="mage--clock-fill text-warning green"></span>
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
        
        <div class="ms-5" style="width:80%">
            <div class="card border-0 shadow rounded-4" style="background-color: #393e1d;">
                <div class="p-4">
                    <div class="d-flex justify-content-between rounded-pill" style="width:100%; height:50px; background-color: #abc337">
                        <button class="btn text-white rounded-pill fw-bold" style="width:100%;">Belum Dibayar</button>
                        <button class="btn text-white rounded-pill fw-bold" style="width:100%; background-color: #889d30;">Disewa</button>
                        <button class="btn text-white rounded-pill fw-bold" style="width:100%;">Selesai</button>  
                    </div>            
                </div>

                <div class="table-responsive px-4 pb-4">
                    <table class="table custom-table text-white text-center">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Durasi Sewa</th>
                                <th>Harga</th>
                                <th>Sisa Hari</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle border-top">
                                <td class="d-flex align-items-center gap-3">
                                <img class="rounded" src="{{ asset('img/profile.jpg') }}" width="100" height="100" style="object-fit: cover;" alt="Bangku">
                                Bangku
                                </td>
                                <td>12/08/2023 s/d 15/08/2023</td>
                                <td>Rp. 20.000</td>
                                <td><span class="badge bg-danger rounded-pill px-3 py-2">2 Hari</span></td>
                            </tr>
                            <tr class="align-middle border-top">
                                <td class="d-flex align-items-center gap-3">
                                <img class="rounded" src="{{ asset('img/profile.jpg') }}" width="100" height="100" style="object-fit: cover;" alt="Bangku 4P">
                                Bangku 4P
                                </td>
                                <td>22/04/2023 s/d 25/04/2023</td>
                                <td>Rp. 133.000</td>
                                <td><span class="badge bg-danger rounded-pill px-3 py-2">2 Hari</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
@endpush