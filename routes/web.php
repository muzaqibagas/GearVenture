<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\GearVentureController;


Route::get('/signin', [GearVentureController::class, 'masuk'])->name('signin.form');
Route::post('/signin', [GearVentureController::class, 'signin'])->name('signin');

Route::get('/signup', [GearVentureController::class, 'form'])->name('signup.form'); // Form pendaftaran
Route::post('/signup', [GearVentureController::class, 'simpan'])->name('signup'); // Proses pendaftaran

// PENYEWA
// Route::get('/', [GearVentureController::class, 'signin'])->name('signin');
Route::get('/index', [GearVentureController::class, 'index'])->name('index');
Route::get('/catalog', [GearVentureController::class, 'catalog'])->name('catalog');

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






