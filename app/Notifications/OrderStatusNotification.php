<?php

namespace App\Notifications;

use App\Models\orders;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Filament\Notifications\Notification as FilamentNotification;

class OrderStatusNotification extends Notification
{
    use Queueable;

    public function __construct(
        public orders $order,
        public string $orderStatus  // ← ganti dari $status ke $orderStatus
    ) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $messages = [
            'Pending'   => 'Pesanan kamu sedang menunggu konfirmasi admin.',
            'processed' => 'Pesanan kamu sedang diproses.',
            'shipped'   => 'Pesanan kamu sedang dikirim.',
            'completed' => 'Pesanan kamu telah selesai.',
            'cancelled' => 'Pesanan kamu telah dibatalkan.',
        ];

        $message = $messages[$this->orderStatus] ?? 'Status pesanan kamu telah diupdate.';

        return FilamentNotification::make()
            ->title('Update Pesanan ' . $this->order->id_pemesanan)
            ->body($message)
            ->icon('heroicon-o-shopping-bag')
            ->iconColor(match($this->orderStatus) {
                'completed' => 'success',
                'cancelled' => 'danger',
                'shipped'   => 'info',
                default     => 'warning',
            })
            ->getDatabaseMessage();
    }
}