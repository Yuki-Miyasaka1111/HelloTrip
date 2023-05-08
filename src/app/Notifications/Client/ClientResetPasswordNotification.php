<?php

namespace App\Notifications\Client;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ClientResetPasswordNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(route('client.password.reset', $this->token, false)))
            ->line('If you did not request a password reset, no further action is required.');
    }
}