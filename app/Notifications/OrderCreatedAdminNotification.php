<?php

namespace App\Notifications;

use App\Mail\CreatedOrderForAdminMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notification;

class OrderCreatedAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Collection|User[]
     */
    private Collection|array $to;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->queue = 'email_admin';
        $this->to = User::whereRoleId(Role::getAdminRole()->id)->get();
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
     */
    public function toMail($notifiable)
    {
        return (new CreatedOrderForAdminMail($notifiable))->to($this->to);
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
