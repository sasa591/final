<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerificationSuccessful extends Notification
{
    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verification Successful')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your email verification was successful.')
            ->line('Your account has been created and you can now log in.')
            ->line('Thank you for joining us!')
            ->salutation(' ');
    }
}
