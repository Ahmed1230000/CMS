<?php

namespace App\Domains\User\Events\User;

use App\Models\User;

class SendWelcomeMessageEvent
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(public readonly User $user)
    {
        //
    }
}
