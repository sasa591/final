<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Post;

class NewPostNotification extends Notification
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Post Created')
            ->greeting('Hello!')
            ->line('A new post has been created by ' . $this->post->first_name . "   " . $this->post->last_name . ':')
            ->line('"' . $this->post->content . '"') // assuming 'content' is the attribute for the post content
            ->action('View Post', url('/hoome'))
            ->line('Thank you for using our application!')
            ->salutation(' ');
    }
}
