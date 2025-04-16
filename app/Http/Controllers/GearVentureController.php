<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GearVentureController extends Controller
{
    // REGISTER
    public function form()
    {
        return view('signup');
    }

    public function tes()
    {
        return view('tes');
    }

    public function simpan(Request $req)
    {
        $req->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:255',    
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create([
            'nama' => $req->nama,
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password), 
            'jenis_kelamin' => $req->jenis_kelamin,
            'role' => $req->role
        ]);

        Auth::login($user);
    
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('pesan', 'Registrasi berhasil, selamat datang Admin!');
        } else {
            return redirect()->route('index')->with('pesan', 'Registrasi berhasil, selamat datang User!');
        }
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
        return view('index');
    }
    public function catalog(){
        return view('catalog');
    }
    public function detail(){
        return view('detail');
    }
    public function event(){
        return view('event');
    }
    public function detailevent(){
        return view('detailevent');
    }
    public function about(){
        return view('about');
    }
    public function penyewaan(){
        return view('penyewaan');
    }
    public function refund(){
        return view('refund');
    }
    public function jadwal(){
        return view('jadwal');
    }
    public function profileuser(){
        return view('profile.profileuser');
    }
    public function edituser(){
        return view('profile.edituser');
    }    
    public function editpw(){
        return view('profile.editpw');
    }    
    public function hapusakun(){
        return view('profile.hapusakun');
    }    
    public function belum(){
        return view('belum');
    }    

    // ADMIN
    public function dashboard(){
        return view('admin.dashboard');
    }



    public function barang(){
        return view('admin.barang');
    }

    public function tambahbarang(){
        return view('admin.tambahbarang');
    }

    public function editbarang(){
        return view('admin.editbarang');
    }



    public function laporan(){
        return view('admin.laporan');
    }

    public function status(){
        return view('admin.status');
    }

    public function pengaturan(){
        return view('admin.pengaturan');
    }



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


