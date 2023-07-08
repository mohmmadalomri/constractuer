<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteNotification extends Notification
{
    use Queueable;
    private $quotes_id;
    private $user_create;
    private $title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quotes_id,$user_create,$title)
    {
        $this->quotes_id = $quotes_id;
        $this->user_create = $user_create;
        $this->title = $title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'quotes_id' => $this->quotes_id,
            'user_create' => $this->user_create,
            'title' => $this->title,
        ];
    }
}
