@extends('layout.appmidtrans')

@section('title', 'Unggah Pembayaran')

@push('style')
@endpush

@section('main')

<section class="catalog py-5 d-flex flex-column align-items-center">
    <a href="javascript:history.back()" class="btn text-white rounded-pill mb-3 align-self-start" style="background-color:#383d1f">&larr; Kembali</a>
    <div class="card shadow-sm border-0" style="width:50%; margin-top:50px">
        <div class="card-body text-center">
            <h2>Unggah Bukti Pembayaran</h2>
            @if(session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pembayaran.upload', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom: 15px;">
                    <label for="bukti_pembayaran" style="margin-bottom: 15px;">Bukti Transfer (jpg/png/pdf):</label><br>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" style="width:15rem" required>
                </div>

                <button class="btn rounded mt-2 text-white" style="background-color:#383d1f" type="submit">upload</button>                
            </form>
        </div>
    </div>
</section>

@endsection

@push('script')
@endpush
