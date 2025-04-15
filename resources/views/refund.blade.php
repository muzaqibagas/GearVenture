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

      <h4 class="mb-2">Metode Pembayaran GearVenture</h4>
      <p>Kami menyediakan beberapa metode pembayaran yang dapat Anda pilih untuk mempermudah transaksi sewa peralatan outdoor di GearVenture:</p>

      <ol>
        <li><strong>Transfer Bank</strong>
          <ul>
            <li>Lakukan transfer ke rekening yang tertera saat checkout.</li>
            <li>Pastikan mencantumkan kode pesanan pada catatan transfer.</li>
            <li>Unggah bukti pembayaran di halaman status penyewaan untuk verifikasi.</li>
          </ul>
        </li>
        <li><strong>E-Wallet (OVO, Dana, GoPay, dll.)</strong>
          <ul>
            <li>Pilih metode e-wallet saat checkout.</li>
            <li>Lakukan pembayaran sesuai dengan nominal yang tertera.</li>
            <li>Konfirmasi pembayaran dengan mengunggah bukti transaksi.</li>
          </ul>
        </li>
        <li><strong>Virtual Account</strong>
          <ul>
            <li>Sistem akan memberikan nomor Virtual Account unik untuk setiap pesanan.</li>
            <li>Lakukan pembayaran melalui ATM, mobile banking, atau internet banking.</li>
            <li>Transaksi akan terverifikasi otomatis dalam beberapa menit.</li>
          </ul>
        </li>
        <li><strong>QRIS</strong>
          <ul>
            <li>Pindai kode QRIS yang muncul di halaman pembayaran.</li>
            <li>Pastikan nominal pembayaran sesuai dengan total pesanan.</li>
            <li>Pembayaran akan terkonfirmasi otomatis.</li>
          </ul>
        </li>
      </ol>

      <h4 class="mt-4 mb-2">Konfirmasi Pembayaran</h4>
      <p>Setelah melakukan pembayaran, Anda perlu mengonfirmasi transaksi dengan mengunggah bukti pembayaran agar pesanan dapat segera diproses. Berikut langkah-langkahnya:</p>

      <ol>
        <li><strong>Masuk ke Akun Anda</strong>
          <ul>
            <li>Login ke akun GearVenture.</li>
            <li>Buka halaman Profile di menu utama.</li>
          </ul>
        </li>
        <li><strong>Unggah Bukti Pembayaran</strong>
          <ul>
            <li>Pilih bagian Status Penyewaan.</li>
            <li>Cari pesanan yang telah dibayar dan klik Unggah Bukti Pembayaran.</li>
            <li>Pastikan foto atau screenshot bukti pembayaran jelas dan sesuai dengan transaksi.</li>
          </ul>
        </li>
        <li><strong>Verifikasi oleh Admin</strong>
          <ul>
            <li>Tim kami akan memeriksa bukti pembayaran dalam waktu maksimal 24 jam.</li>
            <li>Setelah diverifikasi, Anda akan menerima email konfirmasi.</li>
            <li>Status penyewaan akan berubah menjadi Dibayar.</li>
          </ul>
        </li>
        <li><strong>Jika Ada Kendala</strong>
          <ul>
            <li>Jika pembayaran belum terkonfirmasi dalam waktu yang ditentukan, hubungi layanan pelanggan melalui WhatsApp.</li>
            <li>Pastikan informasi pembayaran sesuai untuk mempercepat proses verifikasi.</li>
          </ul>
        </li>
      </ol>
    </div>
  </div>

@endsection

@push('script')
@endpush