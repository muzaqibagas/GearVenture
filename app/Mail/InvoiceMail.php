<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaksis;

    /**
     * Create a new message instance.
     *
     * @param array $transaksis
     */
    public function __construct($transaksis)
    {
        $this->transaksis = $transaksis;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Invoice Pembayaran Sewa Barang')
                    ->markdown('emails.invoice');
    }
}
