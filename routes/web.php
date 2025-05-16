<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\GearVentureController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Mail;


//Get untuk mengambil
//Post untuk mengirim
//Delete
// Route untuk halaman verifikasi notifikasi
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route untuk verifikasi link email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('index'); // atau ke dashboard kamu
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route untuk resend email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ke email kamu!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/verified  ', [GearVentureController::class, 'index']);
    // atau route dashboard lain
});

Route::get('/test-email', function () {
    Mail::raw('Email test berhasil terkirim melalui Mailtrap API!', function ($message) {
        $message->to('dummy@email.com')->subject('Test Mailtrap API');
    });

    return 'Email terkirim!';
});



Route::get('/', [GearVentureController::class, 'masuk'])->name('signin.form');
Route::post('/signin', [GearVentureController::class, 'signin'])->name('signin');

Route::get('/signup', [GearVentureController::class, 'form'])->name('signup.form'); // Form pendaftaran
Route::post('/signup', [GearVentureController::class, 'simpan'])->name('signup'); // Proses pendaftaran
Route::post('/logout', [GearVentureController::class, 'logout'])->name('logout');
// route::delete('/user/{id}', [GearVentureController::class, 'destroy'])->name('user.destroy');

//MIDTRANS
Route::post('/place-order', [MidtransController::class, 'placeOrder']);
Route::resource('/transaksi', OrderController::class);

Route::get('/pesanbaru', [OrderController::class, 'getNotifikasiPesananBaru'])->name('pesanbaru');
Route::get('/notifikasi/{id}/tandai', [OrderController::class, 'tandaiNotifikasiSudahDibaca'])->name('tandai.notifikasi');
Route::get('/admin/status', [OrderController::class, 'statusView'])->name('status');
Route::get('/laporans', [OrderController::class, 'laporans'])->name('laporans');

// PENYEWA
// Route::get('/', [GearVentureController::class, 'signin'])->name('signin');
Route::get('/index', [GearVentureController::class, 'index'])->name('index');
Route::get('/tes', [GearVentureController::class, 'tes'])->name('tes');

Route::get('/catalog', [GearVentureController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{nama?}', [GearVentureController::class, 'filterByKategori'])->name('catalog.kategori');

Route::get('/detail/{id}', [GearVentureController::class, 'detail'])->name('detail');

Route::get('/event', [GearVentureController::class, 'event'])->name('event');
Route::get('/detailevent/{id}', [GearVentureController::class, 'detailevent'])->name('detailevent');
Route::get('/about', [GearVentureController::class, 'about'])->name('about');
Route::get('/penyewaan', [GearVentureController::class, 'penyewaan'])->name('penyewaan');
Route::get('/refund', [GearVentureController::class, 'refund'])->name('refund');
Route::get('/jadwal', [GearVentureController::class, 'jadwal'])->name('jadwal');
Route::get('/profile/user', [GearVentureController::class, 'profileuser'])->name('profileuser');
Route::get('/profile/edituser', [GearVentureController::class, 'edituser'])->name('edituser');
Route::post('/profile/updateuser', [GearVentureController::class, 'updateuser'])->name('updateuser');
Route::get('/profile/editpw', [GearVentureController::class, 'editpw'])->name('editpw');
Route::post('/profile/updatepw', [GearVentureController::class, 'updatepw'])->name('updatepw');
Route::delete('/profile/hapusakun', [GearVentureController::class, 'hapusakun'])->name('hapusakun');
Route::get('/profile/deleteakun', [GearVentureController::class, 'deleteakun'])->name('deleteakun');
Route::get('/profile/belum', [GearVentureController::class, 'belum'])->name('belum');
Route::get('/profile/sewa', [GearVentureController::class, 'sewa'])->name('sewa');
Route::get('/profile/selesai', [GearVentureController::class, 'selesai'])->name('selesai');
Route::get('/checkout', [GearVentureController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [GearVentureController::class, 'storecheckout'])->name('checkout.store');
Route::get('/keranjang', [GearVentureController::class, 'keranjang'])->name('keranjang');
Route::post('/keranjang/tambahkeranjang', [GearVentureController::class, 'tambahkeranjang'])->name('keranjang.tambah');
Route::delete('/keranjang/hapus/{id}', [GearVentureController::class, 'hapusKeranjang'])->name('keranjang.hapus');
Route::resource('/pesanan', OrderController::class);
Route::patch('/transaksi/{id}/status-pembayaran', [GearVentureController::class, 'updateStatusPembayaran'])->name('transaksi.updateStatusPembayaran');
Route::patch('/transaksi/{id}/status-peminjaman', [GearVentureController::class, 'updateStatusPeminjaman'])->name('transaksi.updateStatusPeminjaman');
Route::get('/pembayaran/unggah/{id}', [GearVentureController::class, 'unggah'])->name('pembayaran.unggah');
Route::post('/pembayaran/upload/{id}', [GearVentureController::class, 'upload'])->name('pembayaran.upload');

// ADMIN
Route::get('/admin/dashboard', [GearVentureController::class, 'dashboard'])->name('dashboard');

//BARANG
Route::get('/admin/barang', [GearVentureController::class, 'barang'])->name('barang'); //semua produk dsini
Route::get('/admin/tambahbarang', [GearVentureController::class, 'tambahbarang'])->name('tambahbarang'); //form tambah barang
Route::post('/admin/barang', [GearVentureController::class, 'store'])->name('storebarang'); //create barang
Route::get('/admin/editbarang/{id}', [GearVentureController::class, 'editbarang'])->name('editbarang'); //form edit barang
Route::post('/admin/updatebarang/{id}', [GearVentureController::class, 'updatebarang'])->name('updatebarang'); //update barang
Route::get('/admin/barang/{id}', [GearVentureController::class, 'deletebarang'])->name('deletebarang'); //delete barang

//KATEGORI
Route::get('/admin/kategori', [GearVentureController::class, 'kategori'])->name('kategori');//semua kategori dsini
Route::get('/admin/tambahkategori', [GearVentureController::class, 'tambahkategori'])->name('tambahkategori'); //form tambah kategori
Route::post('/admin/kategori', [GearVentureController::class, 'storekategori'])->name('storekategori'); //create kategori
Route::get('/admin/editkategori/{id}', [GearVentureController::class, 'editkategori'])->name('editkategori'); //form edit kategori
Route::post('/admin/updatekategori/{id}', [GearVentureController::class, 'updatekategori'])->name('updatekategori'); //update kategori
Route::get('/admin/kategori/{id}', [GearVentureController::class, 'deletekategori'])->name('deletekategori'); //delete kategori

Route::get('/admin/laporan', [GearVentureController::class, 'laporan'])->name('laporan');
Route::get('/admin/status', [GearVentureController::class, 'status'])->name('status');

Route::get('/api/produk/{id}', function($id) {
    // Ambil produk beserta foto yang terkait
    $produk = App\Models\Barang::with('fotoBarangs')->findOrFail($id);

    // Ambil gambar pertama dari fotoBarangs, jika ada
    $foto = $produk->fotoBarangs->first(); 

    return response()->json([
        'deskripsi' => $produk->deskripsi,
        'nama' => $produk->nama,
        'harga_sewa' => $produk->harga_sewa,
        'foto' => $foto ? $foto->foto : null,  // Kembalikan nama foto jika ada, atau null
    ]);
});

// Route::get('/reset-keranjang', function () {
//     session()->forget('keranjang');
//     return redirect()->back()->with('success', 'Keranjang berhasil direset.');
// });

Route::get('/admin/konten', [GearVentureController::class, 'konten'])->name('konten');//semua konten ada dsini
Route::get('/admin/tambahkonten', [GearVentureController::class, 'tambahkonten'])->name('tambahkonten');//form tambah konten
Route::post('/admin/konten', [GearVentureController::class, 'storekonten'])->name('storekonten'); //create kategori
Route::get('/admin/editkonten/{id}', [GearVentureController::class, 'editkonten'])->name('editkonten');// form edit konten
Route::post('/admin/updatekonten/{id}', [GearVentureController::class, 'updatekonten'])->name('updatekonten'); //update kategori
Route::get('/admin/konten/{id}', [GearVentureController::class, 'deletekonten'])->name('deletekonten'); //delete kategori

Route::get('/admin/katalog', [GearVentureController::class, 'katalog'])->name('katalog');//semua katalog populer ada dsini
Route::get('/admin/tambahkatalog', [GearVentureController::class, 'tambahkatalog'])->name('tambahkatalog');//form tambah katalog populer 
Route::post('/admin/katalog', [GearVentureController::class, 'storekatalog'])->name('storekatalog'); //create kategori
Route::get('/admin/editkatalog/{id}', [GearVentureController::class, 'editkatalog'])->name('editkatalog');//form edit katalog populer 
Route::post('/admin/updatekatalog/{id}', [GearVentureController::class, 'updatekatalog'])->name('updatekatalog'); //update katalog populer 
Route::get('/admin/katalog/{id}', [GearVentureController::class, 'deletekatalog'])->name('deletekatalog'); //delete katalog populer 

Route::get('/admin/events', [GearVentureController::class, 'events'])->name('events');
Route::get('/admin/tambahevent', [GearVentureController::class, 'tambahevent'])->name('tambahevent');
Route::post('/admin/events', [GearVentureController::class, 'storeevent'])->name('storeevent'); //create kategori
Route::get('/admin/editevent/{id}', [GearVentureController::class, 'editevent'])->name('editevent');
Route::post('/admin/updateevent/{id}', [GearVentureController::class, 'updateevent'])->name('updateevent'); //update katalog populer 
Route::get('/admin/events/{id}', [GearVentureController::class, 'deleteevent'])->name('deleteevent'); //delete katalog populer 

Route::get('/admin/profile', [GearVentureController::class, 'profile'])->name('profile');
Route::get('/admin/editprofile', [GearVentureController::class, 'editprofile'])->name('editprofile');
Route::post('/admin/updateprofile', [GearVentureController::class, 'updateprofile'])->name('updateprofile');
Route::post('/admin/updatepassword', [GearVentureController::class, 'updatepassword'])->name('updatepassword');

Route::post('/submit-form', [ContactController::class, 'sendMessage'])->name('sendmesseage');









