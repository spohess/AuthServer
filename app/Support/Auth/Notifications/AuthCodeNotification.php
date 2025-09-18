<?php

declare(strict_types=1);

namespace App\Support\Auth\Notifications;

use App\Support\Auth\Models\AuthCode;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuthCodeNotification extends Notification
{
    use Queueable;

    public function __construct(
        private AuthCode $authCode,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $message = new MailMessage();

        return $message->subject('Auth Code')
            ->greeting('Hello!')
            ->line('Your auth code is: ')
            ->line($this->authCode->code);
    }
}
