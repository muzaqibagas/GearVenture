<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'nomor_hp' => 'required|string|max:20',
            'pesan' => 'required|string',
        ]);

        // Kirim email (contoh menggunakan Mailable)
        Mail::to('senjavana4@gmail.com')->send(new ContactMessage($validated));

        // Menggunakan session flash untuk menampilkan pesan
        session()->flash('success', 'Pesan berhasil dikirim!');

        // Kembali ke halaman sebelumnya dengan pesan flash
        return redirect()->back();
    }
}
