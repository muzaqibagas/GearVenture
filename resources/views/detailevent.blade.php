@extends('layout.app')

@section('title', 'Home')

@push('style')
@endpush

@section('main')

<section class="catalog py-4"> 
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>
    <div class="d-flex justify-content-center">
        <div class="col-lg-8 d-inline-block">        
            <img src="{{ asset('pict/' . $davent->gambar) }}" alt="Camping Easy Peasy" class="img-fluid rounded mb-3" style="height:300px; width:100%">            
            <!-- Menampilkan Judul dari DB -->
            <h4 class="text-center mb-3">{{$davent->judul}}</h4>

            <!-- Menampilkan Isi Artikel dari DB -->
            <div class="mb-3">
                {!! $davent->isi_artikel !!}
            </div>

            <!-- Menampilkan Lokasi dari DB -->
            <h5>Lokasi Acara</h5>
            <div class="mb-3">
                <div class="d-flex gap-2 mb-2">
                    <span class="logos--google-maps"></span>
                    <p class="mb-2">{{$davent->lokasi}}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
@endpush