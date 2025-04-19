<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\GearVentureController;
use Illuminate\Support\Facades\Mail;

// Route untuk halaman verifikasi notifikasi
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route untuk verifikasi link email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/index'); // atau ke dashboard kamu
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route untuk resend email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ke email kamu!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/index  ', [GearVentureController::class, 'index'])->name('index');
    // atau route dashboard lain
});

Route::get('/test-email', function () {
    Mail::raw('Email test berhasil terkirim melalui Mailtrap API!', function ($message) {
        $message->to('dummy@email.com')->subject('Test Mailtrap API');
    });

    return 'Email terkirim!';
});



Route::get('/signin', [GearVentureController::class, 'masuk'])->name('signin.form');
Route::post('/signin', [GearVentureController::class, 'signin'])->name('signin');

Route::get('/signup', [GearVentureController::class, 'form'])->name('signup.form'); // Form pendaftaran
Route::post('/signup', [GearVentureController::class, 'simpan'])->name('signup'); // Proses pendaftaran

// PENYEWA
// Route::get('/', [GearVentureController::class, 'signin'])->name('signin');
Route::get('/index', [GearVentureController::class, 'index'])->name('index');
Route::get('/tes', [GearVentureController::class, 'tes'])->name('tes');
Route::get('/catalog', [GearVentureController::class, 'catalog'])->name('catalog');
Route::get('/detail', [GearVentureController::class, 'detail'])->name('detail');
Route::get('/event', [GearVentureController::class, 'event'])->name('event');
Route::get('/detailevent', [GearVentureController::class, 'detailevent'])->name('detailevent');
Route::get('/about', [GearVentureController::class, 'about'])->name('about');
Route::get('/penyewaan', [GearVentureController::class, 'penyewaan'])->name('penyewaan');
Route::get('/refund', [GearVentureController::class, 'refund'])->name('refund');
Route::get('/jadwal', [GearVentureController::class, 'jadwal'])->name('jadwal');
Route::get('/profile/user', [GearVentureController::class, 'profileuser'])->name('profileuser');
Route::get('/profile/edituser', [GearVentureController::class, 'edituser'])->name('edituser');
Route::get('/profile/editpw', [GearVentureController::class, 'editpw'])->name('editpw');
Route::get('/profile/hapusakun', [GearVentureController::class, 'hapusakun'])->name('hapusakun');
Route::get('/profile/belum', [GearVentureController::class, 'belum'])->name('belum');
Route::get('/profile/sewa', [GearVentureController::class, 'sewa'])->name('sewa');
Route::get('/profile/selesai', [GearVentureController::class, 'selesai'])->name('selesai');
Route::get('/checkout', [GearVentureController::class, 'checkout'])->name('checkout');
Route::get('/keranjang', [GearVentureController::class, 'keranjang'])->name('keranjang');

// ADMIN
Route::get('/admin/dashboard', [GearVentureController::class, 'dashboard'])->name('dashboard');

Route::get('/admin/barang', [GearVentureController::class, 'barang'])->name('barang');
Route::get('/admin/tambahbarang', [GearVentureController::class, 'tambahbarang'])->name('tambahbarang');
Route::get('/admin/editbarang', [GearVentureController::class, 'editbarang'])->name('editbarang');

Route::get('/admin/laporan', [GearVentureController::class, 'laporan'])->name('laporan');
Route::get('/admin/status', [GearVentureController::class, 'status'])->name('status');
Route::get('/admin/pengaturan', function (Request $request) {
    $page = $request->query('page'); 
    if ($page == 'konten') {
        return view('admin.konten');
    } elseif ($page == 'katalog') {
        return view('admin.katalog');
    } elseif ($page == 'event') {
        return view('admin.event');
    }
    return view('admin.pengaturan'); 
});

Route::get('/admin/tambahkonten', [GearVentureController::class, 'tambahkonten'])->name('tambahkonten');
Route::get('/admin/editkonten', [GearVentureController::class, 'editkonten'])->name('editkonten');

Route::get('/admin/tambahkatalog', [GearVentureController::class, 'tambahkatalog'])->name('tambahkatalog');
Route::get('/admin/editkatalog', [GearVentureController::class, 'editkatalog'])->name('editkatalog');

Route::get('/admin/tambahevent', [GearVentureController::class, 'tambahevent'])->name('tambahevent');
Route::get('/admin/editevent', [GearVentureController::class, 'editevent'])->name('editevent');

Route::get('/admin/profile', [GearVentureController::class, 'profile'])->name('profile');
Route::get('/admin/editprofile', [GearVentureController::class, 'editprofile'])->name('editprofile');








