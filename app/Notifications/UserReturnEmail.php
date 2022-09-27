<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserReturnEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $data;


    public function __construct($data)
    {
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
        return (new MailMessage)
                    ->subject('Return of equipment request')
                    ->greeting('Thanks')
                    ->line('Hi, ' .$this->data['name'] . ' we have received your returns request and will review this as soon as possible.')
                    ->line('Please do not return your equipment until you have recieved confirmation that your request has been accepted as this may result in you been turned away.')
                    ->line('Selected campaign: ' .$this->data['campaign'])
                    ->line('Date / Time: ' . \Carbon\Carbon::parse($this->data['date_time'])->format('d/m/Y, H:i'))
                    ->line('Notes: ' .$this->data['notes']);
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
