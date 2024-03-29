<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Http\Resources\NotificationResource as NotificationResource;


class SendMessageNotification extends Notification
{
    use Queueable;
    private $details;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
      // return ['mail'];
        return ['broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/lead/store'))
        //             ->line('Thank you for using our application!');
        return (new MailMessage)
                    ->greeting($this->details['greeting'])
                    ->line($this->details['body'])
                    ->action($this->details['actionText'], $this->details['actionURL'])
                    ->line($this->details['thanks']);
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
            'letter' => $this->details
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'letter' => $this->details
        ];
    }
    
    // public function broadcastAs()
    // {
        
    //     return 'allNotification-event';
    // }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'letter' => new NotificationResource($this->details),
            'count' => $notifiable->unreadNotifications->count(),
        ]);
    }
}
