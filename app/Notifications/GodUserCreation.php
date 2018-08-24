<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class GodUserCreation extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $password;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($usr)
    {
        $this->user = $usr['user'];
        $this->password = $usr['psw'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from(env('APP_NAME') . ' Bot')
            ->image('https://laravel.com/favicon.png')
            ->attachment(function ($attachment) {
                $attachment->title('New superuser created')
                    ->fields([
                        'Name'     => $this->user->full,
                        'Role'     => 'Admin',
                        'eMail'    => $this->user->email,
                        'Password' => $this->password,
                    ]);
            });


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
