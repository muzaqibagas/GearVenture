@extends('layout.app')

@section('title', 'Home')

@push('style')

<link rel="stylesheet" href="{{ asset('template/assets/css/index-responsive.css') }}">
@endpush
@section('main')

<main>
        <section class="banner-slider">
            <div class="owl-carousel">
                <div class="item"><img src="{{ asset('img/banner-02.jpg') }}" alt="Banner 2">
                    <div class="banner-text">Everest</div>
                </div>
                <div class="item"><img src="{{ asset('img/banner-03.jpg') }}" alt="Banner 3">
                    <div class="banner-text">Bromo</div>
                </div>
                <div class="item"><img src="{{ asset('img/banner-04.jpg') }}" alt="Banner 1">
                    <div class="banner-text">Rinjani</div>
                </div>
            </div>            
        </section>
        <section class="promo px-4 mt-5">
            <h2>Promo Item</h2>
            <div class="promo-container">
            @foreach ($dakon as $dabar)   
                <div class="promo-card ps-5 pe-4">
                    <div class="promo-text">
                        <div class="discount mb-2">Up to {{ $dabar->konten->diskon ?? 'Tidak ada diskon' }}%</div>
                        <div class="description mb-3">
                            <h3>{{$dabar->nama}}</h3>                            
                            <p class="text-xs font-weight-bold mb-0">Rp 
                                @php
                                    // Ambil harga sewa dan diskon
                                    $hargaDiskon = $dabar->harga_sewa * (100 - ($dabar->konten->diskon ?? 0)) / 100;
                                @endphp
                                {{ number_format($hargaDiskon, 0, ',', '.') }} <!-- format harga untuk pemisah ribuan -->
                            </p>

                        </div>
                        <a href="{{ route('detail', $dabar->id) }}" class="promo-button px-4">Lihat Selengkapnya</a>
                    </div>
                    <img src="{{ asset('pict/'.$dabar->foto)}}" alt="Tenda" class="promo-image">
                </div>
            @endforeach                      
            </div>         
        </section>

        <section class="catalog mt-5">
            <h2>Katalog Popular</h2>
            <div class="catalog-container">
                @foreach($dakat as $item)
                    <div class="catalog-card">
                        <img src="{{ asset('pict/'.$item->produk->foto) }}" alt="Kursi Kramat" class="catalog-image">
                        <div class="catalog-title">                            
                            <a href="{{ route('detail', $item->produk->id) }}" class="catalog-title text-decoration-none">{{ $item->produk->nama ?? 'Nama tidak tersedia' }}</a>
                        </div>                        
                        <div class="catalog-price">
                            @php
                                // Periksa apakah ada diskon
                                $hargaDiskon = $item->produk->harga_sewa * (100 - ($item->produk->konten->diskon ?? 0)) / 100;
                            @endphp
                            <!-- Jika ada diskon, tampilkan harga setelah diskon -->
                            @if($item->produk->konten && $item->produk->konten->diskon > 0)
                                <span class="text-decoration-line-through text-danger">Rp {{ number_format($item->produk->harga_sewa, 0, ',', '.') }}</span>
                                Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                            @else
                                <!-- Jika tidak ada diskon, tampilkan harga biasa -->
                                Rp {{ number_format($item->produk->harga_sewa, 0, ',', '.') }}
                            @endif
                        </div>
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $item->Rating)
                                <i class="fas fa-star text-yellow-400"></i> <!-- bintang penuh -->
                            @else
                                <i class="far fa-star text-gray-400"></i> <!-- bintang kosong -->
                            @endif
                            @endfor
                        </div>
                    </div>
                @endforeach  
            </div>
        </section>

        <section class="testimonial">
            <h2 class="mb-4">Apa kata Mereka Tantang GearVenture</h2>
            <div class="testimonial-slider testimonial-carousel owl-carousel">
                <div class="testimonial-item">
                    <i class='bx bxs-quote-alt-left'></i> 
                    <p>“Layanan sangat memuaskan dan mudah dipasang. Pengalaman jadi lebih menyenangkan dengan GearVenture!”</p>
                    <div class="testimonial-info"> 
                        <img src="{{ asset('img/th.jpeg') }}" alt="Asha Jipa">
                        <div class="testimonial-name">Asha Jipa</div>
                    </div>
                </div>

                <div class="testimonial-item">
                    <i class='bx bxs-quote-alt-left'></i> <!-- Kutipan kiri -->
                    <p>“Proses sewa cepat dan mudah, peralatan selalu dalam kondisi bagus!”</p>
                    <div class="testimonial-info"> 
                        <img src="{{ asset('img/th.jpeg') }}" alt="Zaki Bagas">
                        <div class="testimonial-name">Zaki Bagas</div>
                    </div>
                </div>

                <div class="testimonial-item">
                    <i class='bx bxs-quote-alt-left'></i> <!-- Kutipan kiri -->
                    <p>“Saya suka dengan variasi alat yang tersedia, mulai dari tenda hingga peralatan masak.”</p>
                    <div class="testimonial-info"> 
                        <img src="{{ asset('img/th.jpeg') }}" alt="Apis Padil">
                        <div class="testimonial-name">Apis Padil</div>
                    </div>
                </div>

                <div class="testimonial-item">
                    <i class='bx bxs-quote-alt-left'></i> <!-- Kutipan kiri -->
                    <p>“Saya suka dengan variasi alat yang tersedia, mulai dari tenda hingga peralatan masak.”</p>
                    <div class="testimonial-info"> 
                        <img src="{{ asset('img/th.jpeg') }}" alt="Apis Padil">
                        <div class="testimonial-name">Apis Padil</div>
                    </div>
                </div>
            </div>  
        </section>
        
        <section class="contact px-4">
            <h2>CONTACT US</h2>
            <div class="map-container mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.911579667986!2d-74.00601548459438!3d40.71277627933026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1633155780197" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="pesan">
                <div class="contact-info">
                    <div class="info-item">
                        <li><a href="#"><i class='bx bx-phone'></i></a></li>                    
                        <p><b>Phone</b><br>+62 813 8071 6742</p>
                    </div>
                    <div class="info-item">
                        <li><a href="#"><i class='bx bxl-gmail'></i></a></li>
                        <p><b>Email</b><br>GearVenture@gmail.com</p>
                    </div>
                </div>

                <!-- Contact Form -->
                <form class="contact-form" method="POST" action="{{ route('sendmesseage') }}">                    
                    @csrf
                    <div class="form-group">
                        <input class="rounded-0" type="text" name="nama" placeholder="Nama *">
                        <input class="rounded-0" type="email" name="email" placeholder="Email *" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <input class="rounded-0" type="text" name="nomor_hp" placeholder="Nomor Hp *">
                    <textarea class="rounded-0" name="pesan" placeholder="Tulis Pesanmu Disini"></textarea>
                    <button class="rounded fw-bold" type="submit">KIRIM</button>
                </form>
            </div>
        </section>
    </main>

@endsection

@push('script')
@endpush