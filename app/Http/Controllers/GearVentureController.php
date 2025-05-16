<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Barang;
use App\Models\Event;
use App\Models\FotoBarang;
use App\Models\KategoriProduk;
use App\Models\Keranjang;
use App\Models\KeranjangItem;
use App\Models\Konten;
use App\Models\ProdukPopuler;
use App\Models\Transaksi;
use App\Models\User;
use App\Mail\InvoiceMail;

class GearVentureController extends Controller
{
    public function tes()
    {
        return view('tes');
    }

    // REGISTER
    public function form()
    {
        return view('signup');
    }

    public function simpan(Request $req){
        $req->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'role' => 'required|in:user',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::create([
            'nama' => $req->nama,
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'jenis_kelamin' => $req->jenis_kelamin,
            'role' => 'user',
            'foto' => 'default.jpg'
        ]);

        // Kirim link verifikasi email
        $user->sendEmailVerificationNotification();

        // Login dulu supaya bisa ke halaman verifikasi
        Auth::login($user);        

        return redirect()->route('verification.notice');
    }

    // LOGIN
    public function masuk()
    {
        return view('signin');
    }

    public function signin(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return back()->withErrors(['loginError' => 'Akun belum terdaftar.']);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['loginError' => 'Username atau password salah!']);
        }

        if ($user->role === 'admin') {
            Auth::guard('admin')->login($user);
            return redirect()->route('dashboard');
        } else {
            Auth::guard('web')->login($user);
            return redirect()->route('index');
        }
    }



    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('signin.form');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    }

    // PENYEWA
    public function index(){
        $data = Barang::all();
        $dakon = Barang::with('konten')
            ->whereHas('konten', function($q){
                $q->whereNotNull('diskon')->where('diskon', '>', 0); // hanya yang ada diskon
            })->get();
        $dakats = ProdukPopuler::all();        
        $dakat = ProdukPopuler::with('produk')->get();    
        return view('index', [
            'type_menu' => 'index',
            'data' => $data,
            'dakon' => $dakon,
            'dakat' => $dakat,
        ]);
    }
    
    public function catalog(){
        $data = Barang::with('kategori')->paginate(9);
        $kategori = $data->pluck('kategori')->unique('nama');
        $dakon = Barang::with('konten')
            ->whereHas('konten', function($q){
                $q->whereNotNull('diskon')->where('diskon', '>', 0); // hanya yang ada diskon
            })->get();
        $dakat = ProdukPopuler::with(['produk.fotoBarangs'])->get();    
        return view('catalog', [
            'type_menu'=> 'catalog', 
            'data' => $data, 
            'kategori' => $kategori,
            'dakon' => $dakon,
            'dakat' => $dakat,
        ]);                
    }

    public function filterByKategori($nama) {
        $data = Barang::whereHas('kategori', function($query) use ($nama) {
            $query->where('nama', $nama);
        })->with('kategori')->paginate(9);
    
        // Ambil semua kategori (tetap ditampilkan)
        $allData = Barang::with('kategori')->get();
        $kategori = $allData->pluck('kategori')->unique('nama');
        $dakon = Barang::with('konten')
            ->whereHas('konten', function($q){
                $q->whereNotNull('diskon')->where('diskon', '>', 0); // hanya yang ada diskon
            })->get();
        $dakat = ProdukPopuler::with('produk')->get();    
    
        return view('catalog', [
            'type_menu' => 'catalog',
            'data' => $data,
            'kategori' => $kategori,
            'selectedKategori' => $nama,
            'dakon' => $dakon,
            'dakat' => $dakat,
        ]);
    }

    public function detail($id){
        $data = Barang::with('fotoBarangs')->findOrFail($id);

        // Jika layanan tambahan tersedia sebagai array atau data lain
        $layananTambahan = [
            'meja_lipat' => 10000,
            'kursi_lipat' => 5000,
            'hammock' => 20000,
            'lampu_led' => 8000,
            'senter_kepala' => 6000,
            'lentera_gantung' => 7000,
            'flysheet' => 15000,
            'ground_sheet' => 10000,
            'terpal' => 12000,
        ];

        $dakon = Barang::with('konten')
            ->whereHas('konten', function($q) {
                $q->whereNotNull('diskon')->where('diskon', '>', 0); // hanya yang ada diskon
            })->get();

        $dacak = Barang::with(['kategori', 'fotoBarangs'])
            ->where('kategori_id','!=', $data->kategori_id)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get();  
        // dd($dacak);
        return view('detail', [
            'type_menu' => 'catalog',
            'data' => $data,
            'dakon' => $dakon,
            'dacak' => $dacak,
            'layananTambahan' => $layananTambahan, // Kirim layanan tambahan ke view
        ]);
    }

    public function event(){
        $data = Event::paginate(9); // Ambil 9 data per halaman
        return view('event', [
            'type_menu' => 'event',
            'data' => $data,
        ]);
    }
    
    public function detailevent($id){
        $davent = Event::with('fotoBarangs')->findOrFail($id);
        return view('detailevent', [
            'type_menu'=> 'detailevent',
            'davent' => $davent,
        ]);
    }
    public function about(){
        return view('about', [
            'type_menu'=> 'about'
        ]);
    }
    public function penyewaan(){
        return view('penyewaan', [
            'type_menu'=> 'penyewaan'
        ]);
    }
    public function refund(){
        return view('refund', [
            'type_menu'=> 'refund'
        ]);
    }
    public function jadwal(){
        return view('jadwal', [
            'type_menu'=> 'jadwal'
        ]);
    }
    public function profileuser(){
        $penyewa = Auth::user();        
        return view('profile.profileuser', [
            'type_menu'=> 'user',
            'penyewa' => $penyewa,
        ]);
    }

    public function edituser(){
        $penyewa = Auth::user();
        return view('profile.edituser', [
            'type_menu'=> 'edituser',
            'penyewa' => $penyewa,
        ]);
    }    

    public function updateuser(Request $request){
        $penyewa = Auth::guard('web')->user();

        if ($request->hasfile('foto')){
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = $request->file('foto');

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName(); // tambahkan time biar unique
            $file->move(public_path('foto/user'), $filename);
            $penyewa->foto = $filename;
        }

        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'jenis_kelamin' => 'required'
        ]);

        $penyewa->username = $request->username;
        $penyewa->nama = $request->nama;
        $penyewa->email = $request->email;
        $penyewa->jenis_kelamin = $request->jenis_kelamin;

        if ($request->filled('password')){
            $penyewa->password =bcrypt($request->password);
        }

        $penyewa->save();
        return redirect()->back()->with('sukses', 'Profil berhasil diperbarui.');
    }

    public function editpw(){
        $penyewa = Auth::user();
        return view('profile.editpw', [
            'type_menu'=> 'editpw',
            'penyewa' => $penyewa,
        ]);
    }    
    
    public function updatepw(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::guard('web')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->password =bcrypt($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
    
    public function deleteakun(){
        $user = Auth::user();

        return view('profile.hapusakun', [
            'type_menu'=> 'hapusakun',
            'user' => $user // ← ini penting
        ]);
    }

    public function hapusakun() {
        $user = Auth::user();
    
        if ($user) {
            $user->delete();
            Auth::logout();
            return redirect()->route('signin.form')->with('message', 'Akun berhasil dihapus.');
        }
    
        return redirect()->route('signin.form')->withErrors(['error' => 'Tidak ada user yang login.']);
    }    

  
    public function belum() {
        $user = Auth::user();

        $transaksi = \App\Models\Transaksi::all();

        foreach ($transaksi as $trx) {
            if (is_string($trx->tambahan)) {
                $decoded = json_decode($trx->tambahan, true);

                if (is_string($decoded)) {
                    $decoded = json_decode($decoded, true);
                }

                $trx->tambahan = $decoded;
                $trx->save();
            }
        }

        $transaksis = Transaksi::with(['produk.fotoBarangs'])
            ->where('user_id', $user->id)            
            ->get();

        return view('profile.belum', [
            'type_menu' => 'belum',
            'transaksis' => $transaksis,
            'transaksi' => $transaksi,
        ]);
    }   
    public function sewa(){
        $user = Auth::user();

        $transaksi = \App\Models\Transaksi::all();

        foreach ($transaksi as $trx) {
            if (is_string($trx->tambahan)) {
                $decoded = json_decode($trx->tambahan, true);

                if (is_string($decoded)) {
                    $decoded = json_decode($decoded, true);
                }

                $trx->tambahan = $decoded;
                $trx->save();
            }
        }

        $transaksis = Transaksi::with(['produk.fotoBarangs'])
            ->where('user_id', $user->id)  
            ->where('status_peminjaman', '!=', 'selesai')          
            ->get();

        return view('profile.sewa', [
            'type_menu'=> 'sewa',
            'transaksis' => $transaksis,
            'transaksi' => $transaksi,
        ]);
    }    
    public function selesai(){
        $user = Auth::user();

        $transaksi = \App\Models\Transaksi::all();

        foreach ($transaksi as $trx) {
            if (is_string($trx->tambahan)) {
                $decoded = json_decode($trx->tambahan, true);

                if (is_string($decoded)) {
                    $decoded = json_decode($decoded, true);
                }

                $trx->tambahan = $decoded;
                $trx->save();
            }
        }

        $transaksis = Transaksi::with(['produk.fotoBarangs'])
            ->where('user_id', $user->id)  
            ->where('status_peminjaman', 'selesai')          
            ->get();

        return view('profile.selesai', [
            'type_menu'=> 'selesai',
            'transaksis' => $transaksis,
            'transaksi' => $transaksi,
        ]);
    }    
    public function checkout(Request $request)
    {
        $itemIds = $request->input('item_ids', []);
    
        // Pastikan ada item yang dipilih
        if (empty($itemIds)) {
            return redirect()->route('keranjang')->with('error', 'Pilih produk yang ingin dibeli.');
        }
    
        // Ambil item keranjang berdasarkan user_id dan hanya yang dipilih (by id)
        $keranjangItems = Keranjang::where('user_id', Auth::id())
                                    ->whereIn('id', $itemIds)
                                    ->get();
    
        $totalHarga = 0;
    
        // Hitung total harga dari item yang dipilih
        foreach ($keranjangItems as $keranjang) {
            foreach ($keranjang->items as $item) {
                $tanggalMulai = \Carbon\Carbon::parse($keranjang->tanggal_mulai);
                $tanggalSelesai = \Carbon\Carbon::parse($keranjang->tanggal_selesai);
                $durasiHari = $tanggalMulai->diffInDays($tanggalSelesai) ?: 1;
    
                $hargaSatuan = $item->produk->harga_sewa ?? 0;
                $diskon = $item->produk->konten->diskon ?? 0;
                $hargaSetelahDiskon = $hargaSatuan * (100 - $diskon) / 100;
    
                $subtotalProduk = $hargaSetelahDiskon * $item->jumlah * $durasiHari;
                $totalLayanan = $item->total_layanan ?? 0;
                $totalItem = $subtotalProduk + $totalLayanan;
    
                $totalHarga += $totalItem; // Tambahkan ke total harga
            }
        }
    
        return view('checkout', [
            'type_menu' => 'checkout',
            'keranjangItems' => $keranjangItems,
            'totalHarga' => $totalHarga,
        ]);
    }   
    
    public function keranjang() {
        $user_id = Auth::id();
        $produk = Barang::all();
        $keranjang = Keranjang::with('items.produk.fotoBarangs')
                ->where('user_id', $user_id)
                ->latest()
                ->get();

        $items = $keranjang->flatMap(function ($keranjang_item) {
            return $keranjang_item->items;
        });
    
        $total = 0;
    
        foreach ($keranjang as $keranjang_item) {
        foreach ($keranjang_item->items as $item) {
            $total_produk = $item->jumlah * $item->harga_setelah_diskon;
            $total_layanan = $item->total_layanan ?? 0;
            $total += $total_produk + $total_layanan;
            }
        }
    
        return view('keranjang', [
            'type_menu' => 'keranjang',
            'keranjang' => $keranjang,
            'items' => $items,
            'total' => $total,
            'produk' => $produk,
        ]);        
    }    
    
    public function tambahkeranjang(Request $request){
        \Log::info('Masuk ke tambahkeranjang');
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'jumlah' => 'required|integer|min:1',
            'produk_id' => 'required|exists:produk,id',
        ]);

        $mulai = Carbon::parse($request->tanggal_mulai);
        $selesai = Carbon::parse($request->tanggal_selesai);
        $durasi = $mulai->diffInDays($selesai);

        if ($durasi < 2) {
            return redirect()->back()->withInput()->withErrors(['tanggal_selesai' => 'Minimal penyewaan adalah 2 hari.']);
        }

        $produk = Barang::findOrFail($request->produk_id);

        $harga_layanan = [
            'meja_lipat' => 10000,
            'kursi_lipat' => 5000,
            'hammock' => 20000,
            'lampu_led' => 8000,
            'senter_kepala' => 6000,
            'lentera_gantung' => 7000,
            'flysheet' => 15000,
            'ground_sheet' => 10000,
            'terpal' => 12000,
        ];

        $total_layanan = 0;
        $qty_tambahan = $request->qty ?? [];
        $tambahan = $request->tambahan ?? [];

        if (!empty($tambahan)) {
            foreach ($tambahan as $key => $val) {
                $qty = $qty_tambahan[$key] ?? 0;
                $total_layanan += ($harga_layanan[$key] ?? 0) * $qty;
            }
        }

        $harga_per_hari = $produk->harga_sewa;
        $harga_asli_total = $harga_per_hari * $durasi;

        $diskon = $produk->konten->diskon ?? 0;
        $harga_setelah_diskon = $diskon > 0 ? $harga_asli_total * (100 - $diskon) / 100 : $harga_asli_total;

        $total_harga = ($harga_setelah_diskon + $total_layanan) * $request->jumlah;

        // Simpan ke tabel keranjang
        $keranjang = Keranjang::create([
            'user_id' => Auth::id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'durasi' => $durasi,
            'total_harga' => $total_harga,
        ]);

        // Simpan ke keranjang_items
        KeranjangItem::create([
            'keranjang_id' => $keranjang->id,
            'produk_id' => $produk->id,
            'jumlah' => $request->jumlah,
            'harga_asli' => $harga_asli_total,
            'harga_setelah_diskon' => $harga_setelah_diskon,
            'diskon' => $diskon,
            'total_layanan' => $total_layanan,
            'tambahan' => $tambahan,
            'qty_tambahan' => $qty_tambahan,
        ]);

        return redirect()->route('keranjang')->with('success', 'Produk berhasil dimasukkan ke dalam keranjang.');
    }

    public function hapusKeranjang($id)
    {
        $item = KeranjangItem::findOrFail($id);

        // Pastikan item milik user yg sedang login
        if ($item->keranjang->user_id != Auth::id()) {
            abort(403); // Forbidden
        }

        $item->delete();

        return redirect()->route('keranjang')->with('success', 'Item berhasil dihapus.');
    }

// ADMIN
    public function dashboard() {

        $tahunSekarang = now()->year;
        $tahunLalu = now()->subYear()->year;

        $totalBarangDisewakan = Transaksi::where('status', 'lunas')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', $tahunSekarang)
            ->sum('jumlah');

        $totalPendapatan = Transaksi::where('status', 'lunas')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', $tahunSekarang)
            ->sum('total_harga');

        $totalUsers = User::count();
        $totalProduk = Barang::count();
        $laki = User::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = User::where('jenis_kelamin', 'Perempuan')->count();
        $barangHabis = Barang::where('stok', '<=', 0)->get();

        // Tahun sekarang
        $penyewaanPerBulanNow = Transaksi::selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total')
            ->whereYear('created_at', $tahunSekarang)
            ->where('status', 'lunas')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // Tahun lalu
        $penyewaanPerBulanLast = Transaksi::selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total')
            ->whereYear('created_at', $tahunLalu)
            ->where('status', 'lunas')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $penyewaanDataNow = [];
        $penyewaanDataLast = [];
        for ($i = 1; $i <= 12; $i++) {
            $penyewaanDataNow[] = $penyewaanPerBulanNow[$i] ?? 0;
            $penyewaanDataLast[] = $penyewaanPerBulanLast[$i] ?? 0;
        }

        // Tambahkan notifikasi
        $notifikasiBaru = Transaksi::where('is_new', true)->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'laki',
            'perempuan',
            'totalUsers',
            'totalProduk',
            'totalBarangDisewakan',
            'totalPendapatan',
            'penyewaanDataNow',
            'penyewaanDataLast',
            'notifikasiBaru',
            'barangHabis'
        ));
    }

    //BARANG
    public function barang(){
        $data = Barang::all();
        return view('admin.barang', compact('data'));
    }

    //FORM TAMBAH BARANG
    public function tambahbarang(){        
        $kategori = KategoriProduk::all();     
        return view('admin.tambahbarang',  compact('kategori')); 
    }

    //CREATE BARANG
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'harga_sewa' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $cekBarang = Barang::where('nama', $request->nama)->first();
        if ($cekBarang) {
            return redirect()->back()->with('error', 'Barang dengan nama tersebut sudah ada.');
        }
    
        $hargaBersih = str_replace(['Rp', ' ', '.'], '', $request->harga_sewa);
    
        // Simpan barang tanpa kolom foto
        $data = new Barang();
        $data->nama = $request->nama;
        $data->kategori_id = $request->kategori_id;
        $data->harga_sewa = $hargaBersih;
        $data->stok = $request->stok;
        $data->deskripsi = $request->deskripsi;
        $data->save(); // dapatkan ID
    
        if ($request->hasFile('foto')) {
            $files = $request->file('foto');
    
            foreach ($files as $file) {
                $namaFile = uniqid() . '_' . $file->getClientOriginalName();
                $file->move('pict/', $namaFile);
    
                FotoBarang::create([
                    'barang_id' => $data->id,
                    'foto' => $namaFile,
                ]);
            }
        }
    
        return redirect()->route('barang')->with('sukses', 'Barang Berhasil Ditambahkan');
    }
    
    
    //FORM EDIT BARANG
    public function editbarang($id)
    {
        $data = Barang::with('kategori')->find($id); 
        $kategori = KategoriProduk::all();             
        return view('admin.editbarang', compact('data', 'kategori'));
    }

    //UPDATE BARANG
    public function updatebarang(Request $request, $id){
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga_sewa' => 'required|numeric|min:0',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategori_produk,id',
        ]);

        $data = Barang::findOrFail($id);
        $data->nama = $request->nama;
        $data->deskripsi = $request->deskripsi;
        $data->stok = $request->stok;
        $data->harga_sewa = $request->harga_sewa;
        $data->kategori_id = $request->kategori_id;
        $data->save();

        // ✅ Hapus semua foto lama jika ada foto baru di-upload
        if ($request->hasFile('foto')) {
            foreach ($data->fotoBarangs as $fotoLama) {
                $filePath = public_path('pict/' . $fotoLama->foto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                $fotoLama->delete();
            }

            // Simpan foto baru
            foreach ($request->file('foto') as $index => $file) {
                $namaFile = uniqid() . '_' . $file->getClientOriginalName();
                $file->move('pict/', $namaFile);

                FotoBarang::create([
                    'barang_id' => $data->id,
                    'foto' => $namaFile,
                ]);
            }
        }

        return redirect()->route('barang')->with('sukses', 'Barang berhasil diperbarui');
    }



    //DELETE BARANG
    public function deletebarang($id){
        $data = Barang::find($id);
        $data->delete();
        return redirect()->route('barang')->with('Sukses','Barang Berhasil Dihapus');
    }

    //KATEGORI
    public function kategori(){
        $data = KategoriProduk::all();
        return view('admin.kategori', compact('data'));
    }

    //FORM TAMBAH KATEGORI
    public function tambahkategori(){
        return view('admin.tambahkategori');
    }

    //CREATE KATEGORI
    public function storekategori(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
    
        $cekKategori = KategoriProduk::where('nama', $request->nama)->first();
        if ($cekKategori) {
            return redirect()->back()->with('error', 'Kategori dengan nama tersebut sudah ada.');
        }
    
        $data = new KategoriProduk();
        $data->nama = $request->nama;
        $data->save();
    
        return redirect()->route('kategori')->with('sukses', 'Kategori Berhasil Ditambahkan');        
    }
    

    //FORM EDIT KATEGORI
    public function editkategori($id)
    {                    
        $data = KategoriProduk::find($id);           
        return view('admin.editkategori', compact('data'));
    }    

    //UPDATE KATEGORI
    public function updatekategori(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',            
        ]);
        
        $data = KategoriProduk::findOrFail($id);
        $data->nama = $request->nama;
                
        $data->save();        
        return redirect()->route('kategori')->with('sukses', 'Kategori berhasil diperbarui');
    }
    
    //DELETE KATEGORI
    public function deletekategori($id){
        $data = KategoriProduk::find($id);
        $data->delete();
        return redirect()->route('kategori')->with('Sukses','Kategori Berhasil Dihapus');
    }

    public function laporan(Request $request)
    {
        // Ambil tahun & bulan dari request, default ke tahun sekarang
        $tahun = $request->input('tahun', Carbon::now()->year);        
        $bulan = (int) $request->input('bulan');


        // Ambil daftar tahun yang tersedia dari data transaksi
        $tahunList = Transaksi::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Query transaksi lunas & dikelompokkan berdasarkan barang
        $query = Transaksi::with('produk')
            ->selectRaw('produk_id, SUM(jumlah) as total_penyewaan, SUM(total_harga) as total_pendapatan')
            ->where('status', 'lunas')
            ->whereYear('created_at', $tahun)
            ->groupBy('produk_id');

        // Filter berdasarkan bulan jika ada
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $transaksi = $query->get();

        // Kembalikan tampilan dengan variabel-variabel yang dibutuhkan
        return view('admin.laporan', compact('tahunList', 'tahun', 'bulan', 'transaksi'));
    }

    public function status()
    {
        $user_id = Auth::id();
        $keranjang = Keranjang::with('items.produk')
                ->where('user_id', $user_id)
                ->latest()
                ->get();
         $items = $keranjang->flatMap(function ($keranjang_item) {
            return $keranjang_item->items;
        });
    
        $total = 0;
    
        foreach ($keranjang as $keranjang_item) {
        foreach ($keranjang_item->items as $item) {
            $total_produk = $item->jumlah * $item->harga_setelah_diskon;
            $total_layanan = $item->total_layanan ?? 0;
            $total += $total_produk + $total_layanan;
            }
        }
        $transaksi = \App\Models\Transaksi::all();

        foreach ($transaksi as $trx) {
            if (is_string($trx->tambahan)) {
                $decoded = json_decode($trx->tambahan, true);

                if (is_string($decoded)) {
                    $decoded = json_decode($decoded, true);
                }

                $trx->tambahan = $decoded;
                $trx->save();
            }
        }
        return view('admin.status', compact('transaksi', 'keranjang','items', 'total'));
    }

    //KONTEN
    public function konten(){
        $dakon = Barang::with('konten')->whereHas('konten', function($q){
            $q->whereNotNull('diskon')->where('diskon', '>', 0); // hanya yang ada diskon
        })->get();       
    
        return view('admin.konten', compact('dakon'));
    }    

    //FORM TAMBAH KONTEN
    public function tambahkonten(){   
        $data = Barang::with('fotoBarangs')->get();
        $dakon = Barang::all();     
        return view('admin.tambahkonten', compact('dakon', 'data'));
    }

    //CREATE KONTEN
    public function storekonten(Request $request){
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'diskon' => 'required|numeric|min:0',
        ]);
    
        // Cek apakah konten dengan produk_id yang sama sudah ada
        $cekKonten = Konten::where('produk_id', $request->produk_id)->first();
        if ($cekKonten) {
            return redirect()->back()->with('error', 'Konten untuk produk tersebut sudah ada.');
        }

        $dakon = new Konten();
        $dakon->produk_id = $request->produk_id;
        $dakon->diskon = $request->diskon;
    
        $dakon->save();
    
        return redirect()->route('konten')->with('sukses', 'Konten Berhasil Ditambahkan');
    }
    

    //FORM EDIT KONTEN
    public function editkonten($id){
        $dakon = Konten::find($id);            
        return view('admin.editkonten', compact('dakon'));        
    }
    

    //UPDATE KONTEN
    public function updatekonten(Request $request, $id){        
        $request->validate([
            'diskon' => 'required|integer|min:0|max:100', 
        ]);        

        $dakon = Konten::find($id);        

        if (!$dakon) {
            return response()->json(['message' => 'Konten tidak ditemukan'], 404);
        }

        $dakon->diskon = $request->diskon;
        $dakon->save();

        return redirect()->route('konten')->with('sukses', 'Konten berhasil diperbarui');
    }


    //DELETE KONTEN
    public function deletekonten($id){
        $dakon = Konten::find($id);  
        $dakon->delete();
        return redirect()->route('konten')->with('Sukses','konten Berhasil Dihapus');    
    }

    //KATALOG POPULER
    public function katalog(){                
        $dakat = ProdukPopuler::with('produk.fotoBarangs')->get();        
        return view('admin.katalog', compact('dakat'));
    }
    

    //FORM TAMBAH KATALOG POPULER
    public function tambahkatalog(){
        $dakat = Barang::all();
        return view('admin.tambahkatalog', compact('dakat'));
    }

    //CREATE KATALOG POPULER
    public function storekatalog(Request $request){
        $barang = Barang::find($request->produk_id);

        if (!$barang) {
            return redirect()->route('katalog')->with('error', 'Produk tidak ditemukan');
        }

        $rating = $this->calculateRating($barang->sold); // <- hitung rating otomatis

        $dakat = new ProdukPopuler();
        $dakat->produk_id = $request->produk_id;
        $dakat->Rating = $rating;
        $dakat->save();

        return redirect()->route('katalog')->with('sukses', 'Katalog Berhasil Ditambahkan');
    }

    //FORM EDIT KATALOG POPULER
    public function editkatalog($id){
        $dakat = ProdukPopuler::find($id);
        return view('admin.editkatalog', compact('dakat'));
    }

    //UPDATE KATALOG POPULER
    public function updatekatalog(Request $request, $id){
        $dakat = ProdukPopuler::find($id);

        if (!$dakat) {
            return response()->json(['message' => 'Katalog tidak ditemukan'], 404);
        }        

        $rating = $this->calculateRating($barang->sold); // <- hitung ulang rating otomatis

        $dakat->Rating = $rating;
        $dakat->save();

        return redirect()->route('katalog')->with('sukses', 'Katalog berhasil diperbarui');
    }

    private function calculateRating($sold){
        if ($sold >= 50) {
            return 5;
        } elseif ($sold >= 20) {
            return 4;
        } elseif ($sold >= 10) {
            return 3;
        } elseif ($sold >= 5) {
            return 2;
        } else {
            return 1;
        }
    }

    //DELETE KATALOG POPULER
    public function deletekatalog($id){
        $dakat = ProdukPopuler::find($id);
        $dakat->delete();
        return redirect()->route('katalog')->with('Sukses','Katalog Berhasil Dihapus');    
    }

    //EVENTS
    public function events(){
        $data = Event::all();
        return view('admin.event', compact('data'));
    }    

    //FORM TAMBAH EVENT
    public function tambahevent(){
        $data = Event::all();
        return view('admin.tambahevent', compact('data'));
    }

    //CREATE EVENT
    public function storeevent(Request $request){
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:event,judul',
            'lokasi' => 'required|string|max:255',
            'isi_artikel' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.unique' => 'Judul event sudah digunakan. Silakan gunakan judul lain.',
            'judul.required' => 'Judul event wajib diisi.',
            'lokasi.required' => 'Lokasi event wajib diisi.',
            'isi_artikel.required' => 'Isi artikel tidak boleh kosong.',
            'gambar.required' => 'Gambar event wajib diunggah.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $data = new Event();
        $data->judul = $request->judul;
        $data->lokasi = $request->lokasi;
        $data->isi_artikel = $request->isi_artikel;
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move('pict/', $namaFile);
            $data->gambar = $namaFile;
        }
    
        $data->save();
    
        return redirect()->route('events')->with('sukses', 'Event berhasil ditambahkan.');
    }

    //FORM EDIT EVENT
    public function editevent($id){
        $data = Event::find($id);
        return view('admin.editevent', compact('data'));
    }

    //UPDATE EVENT
    public function updateevent(Request $request, $id){
        $request->validate([
            'judul' => 'required|string|max:255|unique:event,judul,' . $id,
            'lokasi' => 'required|string|max:255',
            'isi_artikel' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.unique' => 'Judul event sudah digunakan. Silakan gunakan judul lain.',
            'judul.required' => 'Judul event wajib diisi.',
            'lokasi.required' => 'Lokasi event wajib diisi.',
            'isi_artikel.required' => 'Isi artikel tidak boleh kosong.',
            'gambar.required' => 'Gambar event wajib diunggah.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = Event::findOrFail($id);
        $data->judul = $request->judul;
        $data->lokasi = $request->lokasi;
        $data->isi_artikel = $request->isi_artikel;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move('pict/', $namaFile);
            $data->gambar = $namaFile;
        }

        $data->save();

        return redirect()->route('events')->with('sukses', 'Event berhasil diperbarui.');
    }

    //DELETE EVENT
    public function deleteevent($id){
        $data = Event::find($id);
        $data->delete();
        return redirect()->route('events')->with('sukses','Barang Berhasil Dihapus');
    }

    public function profile(){
        $profile = Auth::user();        
        return view('admin.profile', compact('profile'));
    
    }

    public function editprofile(){
        $profile = Auth::guard('admin')->user();
        return view('admin.editprofile',compact('profile'));
    }

    public function updateprofile(Request $request){        
        $profile = Auth::guard('admin')->user();

        if ($request->hasFile('foto')) {            
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
                
            $file = $request->file('foto');
                        
            $path = 'foto/user/' . $file->getClientOriginalName();                
            $file->move(public_path('foto/user'), $path);
                
            $profile->foto = $path;
        }

        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
        ]);

        $profile->username = $request->username;
        $profile->nama = $request->nama;
        $profile->email = $request->email;
        $profile->jenis_kelamin = $request->jenis_kelamin;

        if ($request->filled('password')) {
            $profile->password = bcrypt($request->password);
        }

        $profile->save();

        return redirect()->back()->with('sukses', 'Profil berhasil diperbarui.');
    }

    public function updatepassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);
    
        $admin = Auth::guard('admin')->user();
    
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }
    
        $admin->password = bcrypt($request->new_password);
        $admin->save();
    
        return back()->with('success', 'Password berhasil diperbarui.');
    }    
    public function updateStatusPembayaran($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'lunas';
        $transaksi->save();

        return redirect()->back()->with('success', 'Status pembayaran berhasil diubah menjadi lunas.');
    }
    public function updateStatusPeminjaman(Request $request, $id)
    {   
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_peminjaman = $request->status_peminjaman;
        $transaksi->save();

        return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui.');
    }
    public function unggah($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $type_menu = 'transaksi';
        return view('unggah', compact('transaksi', 'type_menu'));
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Tentukan folder tujuan di dalam public
        $destinationPath = public_path('bukti_pembayaran');

        // Pastikan folder tujuan ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Simpan file langsung ke public/bukti_pembayaran
        $file = $request->file('bukti_pembayaran');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        // Simpan path file di database (pastikan ada kolom `bukti_pembayaran`)
        $transaksi->bukti_pembayaran = 'bukti_pembayaran/' . $fileName;
        $transaksi->status = 'belum lunas';
        $transaksi->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah!');
    }
}


