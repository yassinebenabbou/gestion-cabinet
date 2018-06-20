<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use App\Mail\SendgirdMail;

class SendNotificationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationEvent  $event
     * @return void
     */
    public function handle(NotificationEvent $event)
    {
        $email = new SendgirdMail($event->notification);
        $email->send();
    }
}
