<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use function Symfony\Component\String\b;

class NewAnnouncement extends Notification
{
    use Queueable;

    private $title, $content, $event_location, $event_date, $event_time;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
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
            ->subject($this->title)
            ->greeting('Hello Member. Trust that you are doing well')
            ->line($this->content)
            ->action('Click here to read the rest of the notification in the App', url('/admin/announcements'));
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
            'title' => $this->title,
            'content' => $this->content,
            'event_location' => $this->event_location,
            'event_date' => $this->event_date,
            'event_time' => $this->event_time
        ];
    }
}
