<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriProduk;
use App\Models\ProdukPopuler;
use App\Models\Admin;
use App\Models\Konten;
use App\Models\Barang;
use App\Models\User;

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
        ]);

        $user = User::create([
            'nama' => $req->nama,
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'jenis_kelamin' => $req->jenis_kelamin,
            'role' => 'user'
        ]);

        // Kirim link verifikasi email
        $user->sendEmailVerificationNotification();

        // Login dulu supaya bisa ke halaman verifikasi
        Auth::login($user);

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();

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
        $dakat = ProdukPopuler::with('produk')->get();    
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
        $data = Barang::findOrFail($id);
        $dakon = Barang::with('konten')
            ->whereHas('konten', function($q){
                $q->whereNotNull('diskon')->where('diskon', '>', 0); // hanya yang ada diskon
            })->get();
        return view('detail', [
            'type_menu'=> 'detail',
            'data' => $data,
            'dakon' => $dakon,
        ]);
    }
    public function event(){
        return view('event', [
            'type_menu'=> 'event'
        ]);
    }
    public function detailevent(){
        return view('detailevent', [
            'type_menu'=> 'detailevent'
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
        return view('profile.edituser', [
            'type_menu'=> 'edituser'
        ]);
    }    
    public function editpw(){
        return view('profile.editpw', [
            'type_menu'=> 'editpw'
        ]);
    }        
    public function hapusakun(){
        $user = Auth::user(); // atau Auth::guard('web')->user();

        if ($user) {
            $user->delete();

            // Logout otomatis setelah akun dihapus
            Auth::logout();

            return view('profile.hapusakun', [
                'type_menu' => 'hapusakun',
                'message' => 'Akun berhasil dihapus.'
            ]);
        }

        return redirect()->route('signin.form')->withErrors(['error' => 'Tidak ada user yang login.']);
    }
  
    public function belum(){
        return view('profile.belum', [
            'type_menu'=> 'belum'
        ]);
    }    
    public function sewa(){
        return view('profile.sewa', [
            'type_menu'=> 'sewa'
        ]);
    }    
    public function selesai(){
        return view('profile.selesai', [
            'type_menu'=> 'selesai'
        ]);
    }    
    public function checkout(){
        return view('checkout', [
            'type_menu'=> 'checkout'
        ]);
    }    
    public function keranjang(){
        return view('keranjang', [
            'type_menu'=> 'keranjang'
        ]);
    }    

// ADMIN
    public function dashboard(){
        return view('admin.dashboard');
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
    public function store(Request $request) 
    {        
        $cekBarang = Barang::where('nama', $request->nama)->first();
        if ($cekBarang) {
            // Jika sudah ada, kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Barang dengan nama tersebut sudah ada.');
        }
        $hargaBersih = str_replace(['Rp', ' ', '.'], '', $request->harga_sewa);
        $data = new Barang();
        $data->nama = $request->nama;
        $data->kategori_id = $request->kategori_id;
        $data->harga_sewa = $hargaBersih;
        $data->stok = $request->stok;
        $data->deskripsi = $request->deskripsi;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = $file->getClientOriginalName();
            $file->move('pict/', $namaFile);
            $data->foto = $namaFile; 
        }
        $data->save();
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
    public function updatebarang(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga_sewa' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategori_produk,id', 
        ]);
        
        $data = Barang::findOrFail($id);
        $data->nama = $request->nama;
        $data->deskripsi = $request->deskripsi;
        $data->stok = $request->stok;
        $data->harga_sewa = $request->harga_sewa;
        $data->kategori_id = $request->kategori_id;
               
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = $file->getClientOriginalName();
            $file->move('pict/', $namaFile);
            $data->foto = $namaFile;
        } else {        
            $data->foto = $data->foto;
        }        
        $data->save();        
        return redirect()->route('barang')->with('Sukses', 'Barang berhasil diperbarui');
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
        return redirect()->route('kategori')->with('Sukses', 'Kategori berhasil diperbarui');
    }
    
    //DELETE KATEGORI
    public function deletekategori($id){
        $data = KategoriProduk::find($id);
        $data->delete();
        return redirect()->route('kategori')->with('Sukses','Kategori Berhasil Dihapus');
    }

    public function laporan(){
        return view('admin.laporan');
    }

    public function status(){
        return view('admin.status');
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
        $dakon = Barang::all();     
        return view('admin.tambahkonten', compact('dakon'));
    }

    //CREATE KONTEN
    public function storekonten(Request $request){
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

        return redirect()->route('konten')->with('Sukses', 'Konten berhasil diperbarui');
    }


    //DELETE KONTEN
    public function deletekonten($id){
        $dakon = Konten::find($id);  
        $dakon->delete();
        return redirect()->route('konten')->with('Sukses','konten Berhasil Dihapus');    
    }

    //KATALOG POPULER
    public function katalog(){
        $dakat = ProdukPopuler::with('produk')->get();
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
        return view('admin.event');
    }    

    //FORM TAMBAH EVENT
    public function tambahevent(){
        return view('admin.tambahevent');
    }

    //FORM EDIT EVENT
    public function editevent(){
        return view('admin.editevent');
    }



    public function profile(){
        $profile = Auth::user();
        return view('admin.profile', compact('profile'));
    }

    public function editprofile(){
        return view('admin.editprofile');
    }
}


