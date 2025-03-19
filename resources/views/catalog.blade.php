<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GearVenture</title>
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<body>
    <header>
        <div class="social-icons">
            <ul>
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
            </ul>
        </div>

        <nav class="navbar">
            <a href="index" class="nav-link">Home</a>
            <a href="catalog" class="nav-link active">Rental/Sewa</a>
            <a href="index.html" class="nav-link">Info/Event</a>
            <a href="index.html" class="nav-link">About</a>
        </nav>
    </header>

    <section class="search-section">
        <div class="container">
            <div class="logo">
                <img src="{{ asset('img/logo2.png') }}" alt="Logo">
            </div>
            
            <div class="search-box">
                <input type="text" placeholder="Apa alat yang kamu butuhkan?">
                <button type="submit"><i class='bx bx-search-alt-2'></i></button>
            </div>
                
            <div class="icons">
                <a href="#"><i class='bx bx-cart' ></i></a>
                <a href="#"><i class='bx bx-user-circle'></i></a>                            
            </div>
        </div>
    </section>
    <section class="catalog">
        <div class="katalog">            
            <div class="main-content">
                <div class="filter-bar">
                    <select>
                        <option>Pengurutan: Default</option>
                        <option>Harga Termurah</option>
                        <option>Harga Termahal</option>
                    </select>
                    <select>
                        <option>Kategori</option>
                        <option>Sleeping Gear</option>
                        <option>Tenda & Shelter</option>
                    </select>
                    <div class="pagination">
                        <button>1</button>
                        <button>2</button>
                        <button>3</button>
                        <button>...</button>
                    </div>
                </div>

                <div class="product-grid">
                    <div class="product">
                        <img src="{{ asset('img/banner-01.jpg') }}" alt="Fireplace starterkit mini">
                        <p class="name">Fireplace starterkit mini</p>
                        <p class="price">Rp95.000</p>
                    </div>
                    <div class="product">
                        <img src="{{ asset('img/banner-01.jpg') }}" alt="Barbeque Portable mini">
                        <p class="name">Barbeque Portable mini</p>
                        <p class="price">Rp55.000</p>
                    </div>
                    <div class="product">
                        <img src="{{ asset('img/banner-01.jpg') }}" alt="AstaGear Camping Tent">
                        <p class="name">AstaGear Camping Tent</p>
                        <p class="price">Rp135.000</p>
                    </div>
                    <div class="product">
                        <img src="{{ asset('img/banner-01.jpg') }}" alt="Kalibre Tenda">
                        <p class="name">Kalibre Tenda</p>
                        <p class="price">Rp115.000</p>
                    </div>
                    <div class="product">
                        <img src="{{ asset('img/banner-01.jpg') }}" alt="AVTECH - Flysheet 2x3 Meter">
                        <p class="name">AVTECH - Flysheet 2x3 Meter</p>
                        <p class="price">Rp75.000</p>
                    </div>
                    <div class="product">
                        <img src="{{ asset('img/banner-01.jpg') }}" alt="Portable Triangle Hammock">
                        <p class="name">Portable Triangle Hammock</p>
                        <p class="price">Rp55.000</p>
                    </div>
                </div>
            </div>
            
            <aside class="sidebar">
                <div class="categories">
                    <h3>KATEGORI PRODUK</h3>
                    <button>Sleeping Gear</button>
                    <button>Tenda & Shelter</button>
                    <button>Masak & Makan</button>
                    <button>Keamanan & Survival</button>
                    <button>Aksesoris & Peralatan</button>
                    <button>Peralatan Hiking & Trekking</button>
                </div>

                <div class="discounted-products">
                    <h3>PRODUK DISKON</h3>
                    <ul>
                        <li>Barbeque Portable mini  <span class="discount">Rp135.000</span> Rp235.000</li>
                        <li>Triangle Hammock - Rp110.000 <span class="discount">Rp150.000</span></li>
                        <li>Asta Gear Camp Tent - Rp250.000 <span class="discount">Rp410.000</span></li>
                    </ul>
                </div>

                <div class="featured-products">
                    <h3>PRODUK UNGGULAN</h3>
                    <ul>
                        <li>Barbeque Portable mini - Rp235.000</li>
                        <li>Triangle Hammock - Rp110.000</li>
                        <li>Asta Gear Camp Tent - Rp250.000</li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</body>
</html>