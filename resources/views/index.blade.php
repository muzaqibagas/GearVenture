<?php
session_start();
if(!isset($_SESSION['users'])) {
    header('location:signin.blade.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GearVenture</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<body>
    <header>        
        <div class="social-icons">
            <div class="logo">
                <img src="{{ asset('img/logo2.png') }}" alt="Logo">
            </div>
            <a href="#">GearVenture</a>
            <!-- <ul>
                <li><a href="https://www.facebook.com" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                <li><a href="https://twitter.com" target="_blank"><i class='bx bxl-twitter'></i></a></li>
                <li><a href="https://www.instagram.com/muzaqibagas" target="_blank"><i class='bx bxl-instagram'></i></a></li>
            </ul>
            <div class="vertical-line"></div>
            <ul>
                <li><a href="https://wa.me/6281380716742" target="_blank"><i class='bx bxs-phone'></i></a></li>
                <p><a href="https://wa.me/6281380716742" target="_blank">62 813 8071 6742</a></p>
            </ul>
            <div class="vertical-line"></div>
            <ul>
                <li><a href="mailto:GearVenture@gmail.com"><i class='bx bxl-gmail'></i></a></li>
                <p><a href="mailto:GearVenture@gmail.com">GearVenture@gmail.com</a></p>
            </ul> -->
        </div>
        <div class="right">
            <nav class="navbar">
                <a href="index" class="nav-link active">Home</a>
                <a href="catalog" class="nav-link">Rental/Sewa</a>
                <a href="index.html" class="nav-link">Info/Event</a>
                <a href="index.html" class="nav-link">About</a>
            </nav>
            <div class="profile">
                <div class="icons">
                    <a href="#"><i class='bx bx-cart' ></i></a>
                    <a href="#"><i class='bx bx-user-circle'></i></a>                            
                </div>
            </div>
        </div>
    </header>
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
        <section class="promo">
            <h2>Promo Item</h2>
            <div class="promo-container">
                <div class="promo-card">
                    <div class="promo-text">
                        <div class="discount">Up to 25%</div>
                        <h3>Chestnut Dome Tent</h3>
                        <p>Tenda 4P + Matras + Sleeping Bag</p>
                        <a href="#" class="promo-button">Lihat Selengkapnya</a>
                    </div>
                    <img src="{{ asset('img/banner-04.jpg') }}" alt="Tenda" class="promo-image">
                </div>

                <div class="promo-card">
                    <div class="promo-text">
                        <div class="discount">Up to 55%</div>
                        <h3>Sundown Shelter</h3>
                        <p>Tenda 2P + Matras + Set Kursi Piknik</p>
                        <a href="#" class="promo-button">Lihat Selengkapnya</a>
                    </div>
                    <img src="{{ asset('img/banner-04.jpg') }}" alt="Shelter" class="promo-image">
                </div>
            </div>         
        </section>

        <section class="catalog">
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
            <h2>Apa kata Mereka Tantang GearVenture</h2>
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
        
        <section class="contact">
            <h2>CONTACT US</h2>
            <div class="map-container">
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
                        <input type="text" placeholder="Nama *">
                        <input type="email" placeholder="Email *">
                    </div>
                    <input type="text" placeholder="Nomor Hp *">
                    <textarea placeholder="Tulis Pesanmu Disini"></textarea>
                    <button type="submit">KIRIM</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="{{ asset('img/logo2.png') }}" alt="GearVenture Logo">
                <p>Jl. Kumbang No.14, RT.02/RW.06, Babakan, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16128</p>
            </div>
            <div class="footer-section">
                <h3>Hubungi Kami</h3>
                <ul>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                        <span>+62 813 8072 6742</span>
                    </li>   
                    <li>
                        <i class='bx bx-chevron-right'></i>
                        <span>gearventure@gmail.com</span>
                    </li>                                             
                </ul>
            </div>

            <div class="footer-section">
                <h3>Informasi</h3>
                <ul>
                    <li><i class='bx bx-chevron-right'></i> Cara Sewa</li>
                    <li><i class='bx bx-chevron-right'></i> Cara Booking</li>
                    <li><i class='bx bx-chevron-right'></i> Cara Bayar</li>
                    <li><i class='bx bx-chevron-right'></i> Syarat dan Ketentuan</li>
                    <li><i class='bx bx-chevron-right'></i> Kebijakan dan Privasi</li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Dukung kami</h3>
                <p>Ikuti kami untuk mendapatkan info terbaru!</p>
                <ul>
                    <li><a href="https://wa.me/6281380716742" target="_blank"><i class='bx bxl-tiktok' ></i></a></li>
                    <p><a href="https://wa.me/6281380716742" target="_blank">@RentGearventure</a></p>
                </ul>
                <ul>
                    <li><a href="https://wa.me/6281380716742" target="_blank"><i class='bx bxl-youtube' ></i></a></li>
                    <p><a href="https://wa.me/6281380716742" target="_blank">travel.withGearventure</a></p>
                </ul>
                <ul>
                    <li><a href="https://wa.me/6281380716742" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                    <p><a href="https://wa.me/6281380716742" target="_blank">RentGearventure</a></p>
                </ul>
                <ul>
                    <li><a href="https://wa.me/6281380716742" target="_blank"><i class='bx bxl-instagram-alt' ></i></a></li>
                    <p><a href="https://wa.me/6281380716742" target="_blank">@RentGearventure</a></p>                
            </div>
        </div>
    </footer>

    <!-- Link FontAwesome (Untuk Ikon) -->
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>