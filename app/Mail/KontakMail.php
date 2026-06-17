<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KontakMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nama;
    public string $pengirimEmail;
    public string $telepon;
    public string $subjek;
    public string $pesan;

    public function __construct(string $nama, string $pengirimEmail, string $telepon, string $subjek, string $pesan)
    {
        $this->nama          = $nama;
        $this->pengirimEmail = $pengirimEmail;
        $this->telepon       = $telepon;
        $this->subjek        = $subjek;
        $this->pesan         = $pesan;
    }

    public function build()
    {
        return $this->subject('Pesan Kontak Baru: ' . $this->subjek)
                    ->replyTo($this->pengirimEmail, $this->nama)
                    ->view('emails.kontak');
    }
}
