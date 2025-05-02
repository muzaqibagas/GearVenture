@extends('layout.app')

@section('title', 'Home')

@push('style')
@endpush

@section('main')

<section>
    <div class="d-flex justify-content-center text-center mt-5" style="color:#929c3b">
        <h1>Jelajahi! Destinasi Petualangan Terbaik</br>Anda Bersama Kami</h1>
    </div>
    <div class="container mt-3">
        <div class="event row g-3 justify-content-center">            
            @foreach ($data as $davent)
            <div class="col-md-4 d-flex justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('pict/'.$davent->gambar)}}" class="rounded" style="width:300px; height:300px" alt="Fireplace starterkit mini">
                    <div class="card-body mt-2 d-flex justify-content-center align-items-center gap-2">
                        <span class="logos--google-maps"></span>
                        <a href="{{ route('detailevent') }}" class="fw-bold m-0 text-decoration-none" style="color:inherit">{{$davent->judul}}, {{$davent->lokasi}}</a>
                    </div>
                </div>
            </div>
            @endforeach                                                       
        </div>
    </div>
</section>

@endsection

@push('script')
@endpush