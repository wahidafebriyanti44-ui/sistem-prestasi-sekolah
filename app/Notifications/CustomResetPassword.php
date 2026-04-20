<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPassword
{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        // Ambil nama pengguna (jika ada)
        $nama_pengguna = $notifiable->name ?? explode('@', $notifiable->email)[0];
        
        // Buat URL reset password
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
        
        // Kirim email dengan view custom
        return (new MailMessage)
            ->subject('Reset Password - SIPRES | Sistem Informasi Prestasi Siswa')
            ->view('emails.reset-password', [
                'actionUrl' => $url,
                'nama_pengguna' => $nama_pengguna,
                'token' => $this->token,
                'email' => $notifiable->email,
            ]);
    }
}