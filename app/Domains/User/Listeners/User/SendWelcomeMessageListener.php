<?php

namespace App\Domains\User\Listeners\User;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Domains\User\Events\User\SendWelcomeMessageEvent;
use App\Notifications\SendWelcomeMessageNotification;

class SendWelcomeMessageListener implements ShouldQueue
{
    use InteractsWithQueue;

    public int $tries = 3;
    public int $backoff = 10;


    /*
    |--------------------------------------------------------------------------
    | Handle Event
    |--------------------------------------------------------------------------
    */

    public function handle(SendWelcomeMessageEvent $event): void
    {
        $event->user->notify(new SendWelcomeMessageNotification());
    }
}
