<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SundayReportSubmissions extends Notification
{
    use Queueable;

    public $message;
    public $userEmail;
    public $admin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userEmail)
    {
        // $this->message = $message;
        $this->userEmail = $userEmail;
        // $this->admin = $admin;
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

        $url = url('/admin/sunday-reports');
        $greeting = 'Report submission from: '.$this->userEmail;

        return (new MailMessage)
            ->from(auth()->user()->email, auth()->user()->name)
            ->subject('Sunday Report Submission')
            ->greeting($greeting)
            ->line('This is to notify you that '.$this->userEmail.' has submitted their report. ')
            ->action('View the reports', $url)
            ->salutation('Kind regards, '.$this->userEmail);
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

    public function toDatabase()
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            //
        ];
    }
}
