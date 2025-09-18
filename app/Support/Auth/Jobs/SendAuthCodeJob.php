<?php

declare(strict_types=1);

namespace App\Support\Auth\Jobs;

use App\Support\Auth\Models\AuthCode;
use App\Support\Auth\Models\User;
use App\Support\Auth\Notifications\AuthCodeNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAuthCodeJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly User $user,
        public readonly AuthCode $authCode,
    ) {}

    public function handle(): void
    {
        $this->user->notify(new AuthCodeNotification($this->authCode));
    }
}
