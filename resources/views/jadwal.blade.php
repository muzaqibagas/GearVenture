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
      <a href="refund"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold" style="width:200px; height: 30px;"><i class="bi bi-shield-check me-2"></i>Kebijakan Refund</a>            
      <a href="jadwal"class="d-flex justify-content-center align-items-center text-decoration-none rounded-top text-white fw-bold active-button" style="width:200px; height: 30px;"><i class="bi bi-calendar-event me-2"></i>Penggantian Jadwal</a>                  
    </div>

    <!-- Content Section -->
    <div class="section-wrapper rounded-bottom text-white">
      <h2 class="text-center mb-4">S&K Penggantian Jadwal</h2>
      
      <p>Kami memahami bahwa rencana bisa berubah. Oleh karena itu, GearVenture memberikan kemudahan bagi penyewa untuk melakukan penggantian jadwal penyewaan, dengan ketentuan sebagai berikut:</p>

      <strong>Syarat Penggantian Jadwal:</strong>
      <ol>
        <li>Batas Waktu Pengajuan:
          <ul>
            <li>Pengajuan penggantian jadwal harus dilakukan maksimal H-2 (2 hari sebelum jadwal penyewaan dimulai).</li>            
          </ul>
        </li>
        <li>Jumlah Maksimal Perubahan Jadwal:
          <ul>
            <li>Penyewa dapat melakukan penggantian jadwal maksimal sebanyak 2 kali.</li>          
          </ul>
        </li>
        <li>Ketersediaan Barang:
          <ul>
            <li>Jadwal baru akan disesuaikan dengan ketersediaan barang pada tanggal yang diminta.</li>            
          </ul>
        </li>
        <li>Pengajuan Setelah Tanggal Sewa Dimulai:
          <ul>
            <li>Penggantian jadwal tidak dapat dilakukan jika melewati tanggal penyewaan yang telah ditentukan.</li>            
          </ul>
        </li>
      </ol>

      <strong>Langkah Pengajuan Penggantian Jadwal:</strong>

      <ol>
        <li>Simpan Kode Pesanan Anda
          <ul>
            <li>Pastikan Anda mencatat kode pesanan saat melakukan checkout sebelumnya.</li>            
          </ul>
        </li>
        <li>Hubungi Admin Melalui WhatsApp
          <ul>
            <li>Kirim pesan ke admin GearVenture melalui WhatsApp resmi di nomor: 08xxxxxxxxxx.</li>
            <li>Format pengajuan:</li>
            <li>less</li>
            <li>CopyEdit</li>
            <li>[Pengajuan Ubah Jadwal]Nama: [Nama Anda]Kode Pesanan: [Kode]Tanggal Awal: [dd/mm/yyyy]Tanggal Baru yang Diinginkan: [dd/mm/yyyy]Alasan: [Tulis alasan singkat]</li>
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
      <strong>Catatan Tambahan:</strong>
      <ul>
        <li>Pengajuan dianggap sah setelah mendapat balasan resmi dari admin melalui WhatsApp.</li>
        <li>Jika tanggal baru tidak tersedia, tim admin akan menawarkan opsi tanggal alternatif.</li>
        <li>Pastikan pengajuan dilakukan dalam jam operasional untuk respon lebih cepat.</li>
      </ul>
    </div>
  </div>

@endsection

@push('script')
@endpush