<?php

namespace App\Notifications\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AccountActivationNotification extends Notification
{
    use Queueable;

    protected $client;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Client  $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array<string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/owner/activate/' . $this->client->email_verification_token);

        return (new MailMessage)
            ->line('アカウント有効化のために以下のリンクをクリックしてください。')
            ->action('アカウントを有効化', $url)
            ->line('このメールに心当たりのない場合は、無視してください。');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array<string, string>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}