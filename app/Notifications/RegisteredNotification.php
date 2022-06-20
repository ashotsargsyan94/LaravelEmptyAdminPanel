<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RegisteredNotification extends Notification
{
    private $email;
    private $token;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('verify_email', ['email'=>$this->email, 'token'=>$this->token]);
        return (new MailMessage)
                    ->subject(__('mail.register.subject'))
                    ->view('site.notifications.registered', ['url'=>$url]);
    }
}
