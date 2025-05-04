@extends('layout.app')

@section('title', 'Home')

@push('style')
@endpush

@section('main')
  
  <h1 class="text-uppercase text-center">Informasi dan Petunjuk</h1>
  <h5 class="text-center text-secondary">Informasi dan petunjuk penggunaan situs www.gearventure.com dapat Anda lihat di bawah ini :</h5>
  <div class="container py-4">
    <!-- Header Buttons -->
    <div class="d-flex justify-content-between top-buttons">
      <a href="about"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold" style="width:200px; height: 30px;"><i class="bi bi-credit-card me-2"></i>Pembayaran</a>      
      <a href="penyewaan"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold active-button" style="width:200px; height: 30px;"><i class="bi bi-clipboard-check me-2"></i>Prosedur Penyewaan</a>            
      <a href="refund"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold" style="width:200px; height: 30px;"><i class="bi bi-shield-check me-2"></i>Kebijakan Refund</a>            
      <a href="jadwal"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold" style="width:200px; height: 30px;"><i class="bi bi-calendar-event me-2"></i>Penggantian Jadwal</a>                  
    </div>

    <!-- Content Section -->
    <div class="section-wrapper rounded-bottom text-white">
      <h2 class="text-center mb-4">Prosedur Penyewaan</h2>      
      <ol>
        <li>Silahkan Login di My account, atau registrasi akun dengan mengisi lengkap data diri Anda.</li>        
        <li>Buka halaman Sewa atau Paket Camping dan pilih produk-prouk yang akan Anda sewa.</li>        
        <li>Tekan pada gambar produk sewa untuk melihat detil dan ketersediaan.</li>      
        <li>Untuk booking, pilih tanggal kapan Anda memulai sewa, kemudian;</li>      
        <li>Pilih tanggal kapan Anda selesai menyewa.</li>      
        <li>Apabila tersedia, Anda bisa menyewa lebih dari satu produk.</li>      
        <li>Anda dapat melihat durasi penyewaan dan total biaya sewa.</li>      
        <li>Tekan tombol “Book Now” untuk memasukkan ke dalam keranjang belanja (Cart) Anda.</li>      
        <li>Lihat keranjang belanja apabila sudah selesai, atau anda bisa langsung checkout.</li>      
        <li>Masukkan kupon yang Anda miliki untuk mendapatkan potongan harga.</li>      
        <li>Untuk produk sewa tidak ada pilihan pengiriman dan produk tidak dikirim ke alamat Anda.</li>      
        <li>Namun jika Anda sekaligus membeli produk, maka pemilihan pengiriman dan proses checkout mengikuti cara membeli produk.</li>      
        <li>Pilih metode pembayaran.</li>  
        <li>Tekan tombol “Place Order”.</li>    
        <li>Anda akan menerima bukti pesanan (order received) ke email Anda.</li>    
        <li>Segera selesaikan pembayaran Anda.</li>    
        <li>Pastikan status pembayaran sudah berhasil di My account bagian Orders dan status sewa (booking) sudah terkonfirmasi di bagian Booking.</li>    
        <li>Atau konfirmasi melalui kontak whatsapp kami.</li>    
        <li>Silahkan ambil dan kembalikan produk sewa di Basecamp Sibayak Adventure sesuai jadwal booking Anda pada jam pengambilan /pengembalian alat (check in – check out).</li>    
        <li>Keterlambatan pengembalian akan dianggap penambahan waktu sewa yang dikenakan biaya per hari sesuai harga reguler produk sewa.</li>    
        <li>Kerusakan/kehilangan pada saat penyewaan  menjadi tanggung jawab pelanggan, Kami berhak meminta biaya ganti rugi  kehilangan dan/atau kerusakan sesuai dengan tingkat keparahannya.</li>    
        <li>Pergunakan semestinya dan jagalah produk yang Anda sewa demi kenyamanan kita bersama.</li>    
    </div>
  </div>

@endsection

@push('script')
@endpush