@extends('layout.app')

@section('title', 'Home')

@push('style')
@endpush

@section('main')

<section class="catalog py-4"> 
    <a href="event" class="text-dark rounded-pill">&larr; Kembali</a>
    <div class="d-flex justify-content-center">
        <div class="col-lg-8 d-inline-block">
            <img src="{{ asset('img/banner-02.jpg') }}" alt="Camping Easy Peasy" class="img-fluid rounded mb-3">
            <h4 class="text-center mb-3">Eksplorasi Alam Bersama TerraTrek: Hiking ke Gunung Bromo</h4>
            <p class="text-justify mb-3">Apakah kamu siap untuk petualangan tak terlupakan? Bergabunglah dengan TerraTrek Adventure Club dalam ekspedisi hiking seru ke Gunung Bromo! Rasakan keindahan alam, tantangan mendaki, dan momen sunrise yang spektakuler di salah satu destinasi terbaik Indonesia.</p>
            <h5>Mengapa Harus Ikut?</h5>
            <div class="mb-3">
                <div class="d-flex gap-2">
                    <span class="material-symbols--check-box-rounded" ></span>
                    <p class="mb-2">Pemandangan Spektakuler – Saksikan matahari terbit dari puncak Bromo dengan lautan pasir yang memukau.</p>
                </div>
                <div class="d-flex gap-2">
                    <span class="material-symbols--check-box-rounded" ></span>
                    <p class="mb-2">Udara Segar & Menyehatkan – Hiking adalah cara terbaik untuk melepaskan stres dan meningkatkan kebugaran tubuh.</p>
                </div>
                <div class="d-flex gap-2">
                    <span class="material-symbols--check-box-rounded" ></span>
                    <p class="mb-2">Komunitas yang Solid – Kenalan dengan sesama pecinta alam dan bentuk persahabatan baru.</p>
                </div>
                <div class="d-flex gap-2">
                    <span class="material-symbols--check-box-rounded" ></span>
                    <p class="mb-2">Dokumentasi Keren – Dapatkan foto-foto epik dari perjalananmu, cocok untuk feed Instagram!</p>
                </div>
            </div>

            <h5>Detail Acara</h5>
            <div class="mb-3">
                <div class="d-flex gap-2 mb-2">
                    <span class="noto--calendar"></span>
                    <p class="mb-2">Tanggal: 20-21 April 2025</p>
                </div>
                <div class="d-flex gap-2 mb-2">
                    <span class="logos--google-maps"></span>
                    <p class="mb-2">Lokasi: Gunung Bromo, Jawa Timur</p>
                </div>
                <div class="d-flex gap-2 mb-2">
                    <span class="emojione--money-bag"></span>
                    <p class="mb-2">Biaya Pendaftaran: Rp 450.000 (termasuk transportasi, guide, dan dokumentasi)</p>
                </div>                
            </div>

            <h5>Fasilitas yang didapatkan</h5>
            <div class="mb-3">
                <ul>
                    <li>Transportasi PP dari meeting point</li>
                    <li>Penginapan dan perlengkapan camping</li>
                    <li>Makan dan snack selama perjalanan</li>
                    <li>Dokumentasi foto dan video</li>
                    <li>Tim medis dan pemandu profesional</li>
                </ul>
            </div>

            <h5>Cara Pendaftaran</h5>
            <div class="mb-3">
                <div class="d-flex gap-2 mb-2">
                    <span class="skill-icons--instagram"></span>
                    <p class="mb-2">DM Instagram @terratrek.id atau hubungi </p>
                </div> 
                <div class="d-flex gap-2 mb-2">
                    <span class="fluent-color--phone-laptop-32"></span>
                    <p class="mb-2">+62 812-3456-7890 untuk info lebih lanjut!</p>
                </div> 
            </div>


            
        </div>
    </div>
</section>


@endsection

@push('script')
@endpush