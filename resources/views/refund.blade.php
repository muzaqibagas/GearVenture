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
      <a href="penyewaan"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold" style="width:200px; height: 30px;"><i class="bi bi-clipboard-check me-2"></i>Prosedur Penyewaan</a>            
      <a href="refund"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold active-button" style="width:200px; height: 30px;"><i class="bi bi-shield-check me-2"></i>Kebijakan Refund</a>            
      <a href="jadwal"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold" style="width:200px; height: 30px;"><i class="bi bi-calendar-event me-2"></i>Penggantian Jadwal</a>                  
    </div>

    <!-- Content Section -->
    <div class="section-wrapper rounded-bottom text-white">
      <h2 class="text-center mb-4">Cara Pembayaran GearVenture</h2>
      
      <p>Kami di GearVenture berkomitmen untuk memberikan pengalaman sewa yang terbaik bagi pelanggan kami. Jika terjadi pembatalan pemesanan, refund penuh hanya dapat dilakukan jika pembatalan dilakukan maksimal 3 hari sebelum tanggal sewa dimulai. Pembatalan yang dilakukan dalam waktu kurang dari 3 hari akan dikenakan potongan sebesar 50% dari total pembayaran sebagai kompensasi pemesanan. Tidak ada refund untuk pembatalan di hari H atau setelah peralatan diserahkan. Refund akan diproses dalam 3–5 hari kerja melalui metode pembayaran yang sama. Untuk mengajukan refund, silakan hubungi tim layanan pelanggan kami melalui email atau WhatsApp dengan menyertakan bukti pembayaran dan detail pemesanan Anda.</p>
      
    </div>
  </div>

@endsection

@push('script')
@endpush