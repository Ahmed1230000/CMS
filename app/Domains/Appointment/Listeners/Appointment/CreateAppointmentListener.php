<?php

namespace App\Domains\Appointment\Listeners\Appointment;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Domains\Appointment\Events\Appointment\CreateAppointmentEvent;
use Illuminate\Support\Facades\Cache;

class CreateAppointmentListener implements ShouldQueue
{
    use InteractsWithQueue;

    /*
    |--------------------------------------------------------------------------
    | Handle Event
    |--------------------------------------------------------------------------
    */

    public function handle(CreateAppointmentEvent $event): void
    {
        Cache::forget('dashboard:stats');
    }
}
