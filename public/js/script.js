$(document).ready(function () {
    // Inisialisasi untuk slider testimonial
    $(".testimonial-slider").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        autoHeight: false, // Matikan autoHeight jika diperlukan
        center: true,
        items: 3,
        responsive: {
            0: { items: 1 },
            768: { items: 3 }
        }
    });
    

    // Inisialisasi untuk carousel umum
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        dots: false,
        nav: true,
        autoHeight: false // Mencegah perubahan tinggi otomatis
    });
});
