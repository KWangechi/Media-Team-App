<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SundayReportSubmissions extends Notification
{
    use Queueable;

    private $userEmail;
    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userEmail, $data)
    {
        // $this->message = $message;
        $this->userEmail = $userEmail;
        $this->data = $data;
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

        $url = url(env('APP_URL') . 'admin/sunday-reports');
        $greeting = 'Report submission from: ' . $this->userEmail;

        return (new MailMessage)
            ->from(auth()->user()->email, auth()->user()->name)
            ->subject($this->data['subject'])
            ->greeting($greeting)
            ->line($this->data['body'])
            ->action('View the reports', $url)
            ->salutation($this->data['salutation']);
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
            'message' => $this->data['subject'] .' '. $this->data['body'].' '. $this->data['salutation']

        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            "subject" => $this->data['subject'],
            'body' => $this->data['body'],
            'salutation' => $this->data['salutation']
        ];
    }
}
