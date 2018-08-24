<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminAccountInvitation extends Notification implements ShouldQueue
{
    use Queueable;
    public $password;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password = 'fake')
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
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

        $url = url('/confirm/' . $notifiable->email . '/' . encrypt($this->password));

        return (new MailMessage)

            ->subject(env('APP_NAME') . ' | Account created')
            ->greeting('Hi ' . $notifiable->name)
            ->line('You\'ve been invited to join ' . env('APP_NAME'))
            ->action('Activate your account', $url)
            ->line('Thank you for using our application!')
            ->line($this->password);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
