@extends('layout.app')

@section('title', 'Home')

@push('style')
@endpush

@section('main')

<section>
    <div class="d-flex justify-content-center text-center mt-5" style="color:#929c3b">
        <h1>Jelajahi! Destinasi Petualangan Terbaik</br>Anda Bersama Kami</h1>
    </div>
    <div class="container mt-3 mb-5">
        <div class="event row g-3 justify-content-center">            
            @foreach ($data as $davent)
            <div class="col-md-4 d-flex justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('pict/'.$davent->gambar)}}" class="rounded" style="width:300px; height:300px" alt="Fireplace starterkit mini">
                    <div class="card-body mt-2 d-flex justify-content-center align-items-center gap-2">
                        <span class="logos--google-maps"></span>
                        <a href="{{ route('detailevent', ['id' => $davent->id]) }}" class="fw-bold m-0 text-decoration-none" style="color:inherit">{{$davent->judul}}, {{$davent->lokasi}}</a>
                    </div>
                </div>
            </div>
            @endforeach                                                       
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-lg">
                {{-- Tombol Previous --}}
                @if ($data->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                    @if ($page == $data->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($data->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>

</section>

@endsection

@push('script')
@endpush