<?php

namespace App\Notifications;

use App\Mail\CreatedOrderForCustomerMail;
use App\Models\Order;
use App\Services\Contracts\AwsPublicLinkInterface;
use App\Services\Contracts\InvoicesServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramFile;

class OrderCreatedCustomerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->queue = 'email_customer';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(Order $notifiable)
    {
        $data = ['mail'];
        if ($notifiable->user->telegram_id) {
            $data = array_merge($data, ['telegram']);
        }
        return $data;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail(Order $notifiable)
    {
        return new CreatedOrderForCustomerMail($notifiable);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toTelegram(Order $notifiable)
    {
        $invoicesService = app()->make(InvoicesServiceInterface::class);
        $awsPublicLinkService = app()->make(AwsPublicLinkInterface::class);
        $invoiceFile = $invoicesService->generate($notifiable)->save('s3');
        $invoiceFileUrl = $awsPublicLinkService->generateUri($invoiceFile->filename);

        return TelegramFile::create()
            ->to($notifiable->user->telegram_id)
            ->content('Заказ #' . $notifiable->id . ' успешно создан')
            ->document($invoiceFileUrl, $invoiceFile->filename)
            ->button('Details', route('account.orders.show', $notifiable));
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
