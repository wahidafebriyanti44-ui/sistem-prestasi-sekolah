<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SchoolOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $schoolName;

    public function __construct($otp, $schoolName = null)
    {
        $this->otp = $otp;
        $this->schoolName = $schoolName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Verifikasi Registrasi Sekolah - SIPRES',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.school-otp',
        );
    }
}