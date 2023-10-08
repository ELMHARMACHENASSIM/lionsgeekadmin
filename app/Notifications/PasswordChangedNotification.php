<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordChangedNotification extends Notification
{
    use Queueable;

    protected $newPassword;

    
    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your password has been changed.')
            ->line('Your new password is: ' . $this->newPassword)
            ->action('Login', route('login'))
            ->line('Thank you for using our application!');
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
