<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DutyRosterCreated extends Notification
{
    use Queueable;

    // public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        // $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->salutation('Dear Team Member: ')
            ->greeting('Welcome to Kahawa Sukari Media Team App. Glad to have you on board!!')
            ->line('This is to notify you that you have been selected to lead the service next Saturday.
                    Click the link below to see the message in the app')
            ->action('Go to My announcements', url('/'))
            ->line('Please make sure you confirm your availability before Saturday 2:00pm. See you on Sunday');
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

    public function toDatabase() {
        return [

        ];
    }
}
