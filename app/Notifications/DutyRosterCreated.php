<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DutyRosterCreated extends Notification
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
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
        ->subject($this->message['subject'])
        ->greeting($this->message['greeting'])
        ->line($this->message['body'])
        ->action('Click here to view your leave requests', url('/login'))
        ->salutation($this->message['salutation']);
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


    /**
     * Store the notification in the database
     * This data will be stored in the 'data' column in the notifications table
     * @return array
     */
    public function toDatabase()
    {
        return [
            'subject' => $this->message['subject'],
            'greeting' => $this->message['greeting'],
            'body' => $this->message['body'],
            'salutation' => $this->message['salutation']
        ];
    }
}
