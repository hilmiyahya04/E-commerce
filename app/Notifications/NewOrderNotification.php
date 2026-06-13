<?php

namespace App\Notifications;

use App\Models\orders;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Notifications\Actions\Action;


class NewOrderNotification extends Notification
{
    use Queueable;

    public function __construct(public orders $order)
    {
    }

    /**
     * Delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Database notification for Filament.
     */
    public function toDatabase(object $notifiable): array
    {
        return FilamentNotification::make()
            ->title('Pesanan Baru Masuk!')
            ->icon('heroicon-o-shopping-bag')
            ->iconColor('success')
            ->body(
                'Pesanan dari ' .
                ($this->order->user?->name ?? 'Pelanggan') .
                ' dengan ID ' .
                $this->order->id_pemesanan
            )
            ->getDatabaseMessage();
    }

    /**
     * Mail notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pesanan Baru')
            ->line('Ada pesanan baru yang masuk.')
            ->action('Lihat Pesanan', url('/admin/orders'));
    }

    /**
     * Array representation.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'id_pemesanan' => $this->order->id_pemesanan,
        ];
    }
}