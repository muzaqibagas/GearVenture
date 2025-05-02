<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactMessage extends Mailable
{
    public $nama;
    public $email;
    public $nomor_hp;
    public $pesan;

    public function __construct($data)
    {
        $this->nama = $data['nama'];
        $this->email = $data['email'];
        $this->nomor_hp = $data['nomor_hp'];
        $this->pesan = $data['pesan'];
    }

    public function build()
    {
        return $this->from('no-reply@test-r6ke4n116eygon12.mlsender.net')
                    ->subject('Pesan Kontak dari' . $this->nama)
                    ->view('emails.contact-message')
                    ->with([
                        'nama' => $this->nama,
                        'email' => $this->email,
                        'nomor_hp' => $this->nomor_hp,
                        'pesan' => $this->pesan,
                    ]);
    }
}