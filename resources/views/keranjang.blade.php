@extends('layout.app')

@section('title', 'Home')

@push('style')
@endpush

@section('main')


<section class="catalog py-5 d-flex flex-column align-items-center">
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>

    <!-- Container card -->
    <div class="card shadow-sm rounded-3 border-0 p-3" style="width:90%;">
        <!-- Header tabel -->
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light text-center">
                    <tr>
                        <th></th>
                        <th>Produk</th>
                        <th>Harga Satuan</th>
                        <th>Durasi</th>
                        <th>Kuantitas</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td><input type="checkbox"></td>
                        <td class="text-start">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/banner-02.jpg') }}" class="me-3 rounded" width="70" height="70" alt="Produk 1">
                                <span>Kursi santai piknik outdoor</span>
                            </div>
                        </td>
                        <td>Rp. 85.000</td>
                        <td>20/12/2024 s/d 23/12/2024 <span class="text-warning">&#9998;</span></td>
                        <td>
                            <div class="input-group input-group-sm justify-content-center" style="max-width: 100px;">
                                <button class="btn btn-outline-secondary" type="button">-</button>
                                <input type="text" class="form-control text-center" value="1">
                                <button class="btn btn-outline-secondary" type="button">+</button>
                            </div>
                        </td>
                        <td>Rp. 85.000</td>
                        <td><button class="btn btn-sm btn-white"><i class="mdi--trash-can-empty bg-danger"></i></button></td>
                    </tr>

                    <tr>
                        <td><input type="checkbox"></td>
                        <td class="text-start">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/banner-02.jpg') }}" class="me-3 rounded" width="70" height="70" alt="Produk 2">
                                <span>1 set Kursi santai piknik outdoor 4P</span>
                            </div>
                        </td>
                        <td>Rp. 115.000</td>
                        <td>12/01/2024 s/d 15/01/2024 <span class="text-warning">&#9998;</span></td>
                        <td>
                            <div class="input-group input-group-sm justify-content-center" style="max-width: 100px;">
                                <button class="btn btn-outline-secondary" type="button">-</button>
                                <input type="text" class="form-control text-center" value="2">
                                <button class="btn btn-outline-secondary" type="button">+</button>
                            </div>
                        </td>
                        <td>Rp. 230.000</td>
                        <td><button class="btn btn-sm btn-white"><i class="mdi--trash-can-empty bg-danger"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center p-3 border-top bg-white">
            <div>
                <input type="checkbox" id="semua-produk">
                <label for="semua-produk">Semua Produk</label>
            </div>
            <div class="text-end">
                <span class="me-3">Total (2 produk): <strong>Rp. 315.000</strong></span>
                <a href="{{ route ('checkout')}}" class="btn text-white rounded-pill" style="background-color:#383d1f">Buat Pesanan</a>                
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
@endpush