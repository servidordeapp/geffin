<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class SetTenantIdInSession
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        session()->put('tenant_id', $event->user->tenant_id);
    }
}
