<?php

namespace App\Mail;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use URL;

class apiPasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function build()
    {
        $subject = 'Şifre Sıfırlama Bildirimi';
        return $this->view('auth.passwords.apiResetMail')
            ->subject($subject)
            ->with('api_token',$this->event)
            ->with('level','success')
            ->with('actionText', "Şifre Değiştirme Sayfası")
            ->with('actionUrl', URL::to('password/reset/'.$this->event));
    }
}
