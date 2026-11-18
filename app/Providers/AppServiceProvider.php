<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Reset Password Akun - Game Corner FILKOM UB')
                ->greeting('Halo, ' . $notifiable->name . '!')
                ->line('Kami menerima permintaan pengaturan ulang password untuk akun Game Corner FILKOM UB Anda.')
                ->action('Atur Ulang Password', $url)
                ->line('Tautan reset password ini akan kedaluwarsa dalam 60 menit.')
                ->line('Jika Anda tidak merasa meminta reset password, abaikan email ini.')
                ->salutation("Salam,\nTim Game Corner FILKOM UB");
        });

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Email Akun - Game Corner FILKOM UB')
                ->greeting('Halo, ' . $notifiable->name . '!')
                ->line('Silakan klik tombol di bawah ini untuk memverifikasi alamat email akun Game Corner FILKOM UB Anda.')
                ->action('Verifikasi Email Sekarang', $url)
                ->line('Jika Anda tidak membuat akun ini, abaikan email ini.')
                ->salutation("Salam,\nTim Game Corner FILKOM UB");
        });
    }
}