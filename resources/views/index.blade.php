@extends('layout.app')

@section('title', 'Home')

@push('style')
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
                <div class="promo-card ps-5 pe-4">
                    <div class="promo-text">
                        <div class="discount mb-2">Up to 25%</div>
                        <div class="description mb-3">
                            <h3>Chestnut Dome Tent</h3>
                            <p>Tenda 4P + Matras + Sleeping Bag</p>
                        </div>
                        <a href="#" class="promo-button px-4">Lihat Selengkapnya</a>
                    </div>
                    <img src="{{ asset('img/banner-04.jpg') }}" alt="Tenda" class="promo-image">
                </div>

                <div class="promo-card  ps-5 pe-4">
                    <div class="promo-text">
                        <div class="discount">Up to 55%</div>
                        <div class="description mb-3">
                            <h3>Sundown Shelter</h3>
                            <p>Tenda 2P + Matras + Set Kursi Piknik</p>
                        </div>
                        <a href="#" class="promo-button px-4">Lihat Selengkapnya</a>
                    </div>
                    <img src="{{ asset('img/banner-04.jpg') }}" alt="Shelter" class="promo-image">
                </div>
            </div>         
        </section>

        <section class="catalog mt-5">
            <h2>Katalog Popular</h2>
            <div class="catalog-container">
                <div class="catalog-card">
                    <img src="{{ asset('img/banner-04.jpg') }}" alt="Kursi Kramat" class="catalog-image">
                    <div class="catalog-title">Kursi Kramat</div>
                    <div class="catalog-price">Rp75.000</div>
                    <div class="rating">★★☆☆☆</div>
                </div>

                <div class="catalog-card">
                    <img src="{{ asset('img/banner-04.jpg') }}" alt="Kursi Ijab Kabul" class="catalog-image">
                    <div class="catalog-title">Kursi Ijab Kabul</div>
                    <div class="catalog-price">Rp115.000</div>
                    <div class="rating">★★★☆☆</div>
                </div>

                <div class="catalog-card">
                    <img src="{{ asset('img/banner-04.jpg') }}" alt="Lampu Kehidupan" class="catalog-image">
                    <div class="catalog-title">Lampu Kehidupan</div>
                    <div class="catalog-price">Rp65.000</div>
                    <div class="rating">★★★☆☆</div>
                </div>

                <div class="catalog-card">
                    <img src="{{ asset('img/banner-04.jpg') }}" alt="Minum Doa" class="catalog-image">
                    <div class="catalog-title">Minum Doa</div>
                    <div class="catalog-price">Rp95.000</div>
                    <div class="rating">★★★☆☆</div>
                </div>
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
                <form class="contact-form">
                    <div class="form-group">
                        <input class="rounded-0" type="text" placeholder="Nama *">
                        <input class="rounded-0" type="email" placeholder="Email *">
                    </div>
                    <input class="rounded-0" type="text" placeholder="Nomor Hp *">
                    <textarea class="rounded-0" placeholder="Tulis Pesanmu Disini"></textarea>
                    <button class="rounded fw-bold" type="submit">KIRIM</button>
                </form>
            </div>
        </section>
    </main>

@endsection

@push('script')
@endpush