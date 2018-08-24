<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class AccountActivated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        $picture = '';
        if (isset($notifiable->picture) && ($notifiable->picture != '')) {
            $picture = $notifiable->picture;
        } else {
            $picture = 'https://api.adorable.io/avatars/240/' . $notifiable->email . '.png';
        }
        return (new SlackMessage)
            ->from(env('APP_NAME') . ' Bot')
            ->image($picture)
            ->content('Hi, I\'m ' . $notifiable->full . '. I have activated my account!');
    }

    public function toMail($notifiable)
    {

        return (new MailMessage)

            ->subject(env('APP_NAME') . ' | Account created')
            ->greeting('Congratulation ' . $notifiable->name)
            ->line('Your account has been activated ')
            ->action('Access to', url('/'));

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
