<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriProduk;
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

    public function simpan(Request $req)
    {
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

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('index');
            }
        }

        return back()->withErrors(['loginError' => 'Username atau password salah!']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('signin');
    }

    // PENYEWA
    public function index(){
        return view('index', [
            'type_menu'=> 'index'
        ]);
    }
    public function catalog(){
        return view('catalog', [
            'type_menu'=> 'catalog'
        ]);
    }
    public function detail(){
        return view('detail', [
            'type_menu'=> 'detail'
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
        return view('profile.profileuser', [
            'type_menu'=> 'user'
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
        return view('profile.hapusakun', [
            'type_menu'=> 'hapusakun'
        ]);
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

    //FORM TAMBAH
    public function tambahbarang(){
        return view('admin.tambahbarang'); 
    }

    //CREATE BARANG
    public function store(Request $request) 
    {        
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
    public function storekategori(Request $request)
    {
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

    public function konten(){
        return view('admin.konten');
    }

    public function katalog(){
        return view('admin.katalog');
    }

    public function events(){
        return view('admin.event');
    }

    // public function pengaturan(){
    //     return view('admin.pengaturan');
    // }



    public function tambahkonten(){
        return view('admin.tambahkonten');
    }

    public function editkonten(){
        return view('admin.editkonten');
    }



    public function tambahkatalog(){
        return view('admin.tambahkatalog');
    }

    public function editkatalog(){
        return view('admin.editkatalog');
    }

    public function tambahevent(){
        return view('admin.tambahevent');
    }

    public function editevent(){
        return view('admin.editevent');
    }



    public function profile(){
        return view('admin.profile');
    }

    public function editprofile(){
        return view('admin.editprofile');
    }
}


