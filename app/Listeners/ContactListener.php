<?php

namespace App\Listeners;

use App\Events\ContactEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Notification;
use App\Notifications\contactNotification;

class ContactListener
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
     * @param  ContactEvent  $event
     * @return void
     */
    public function handle(ContactEvent $event)
    {

        $users = User::all();
        Notification::send($users, new contactNotification($event->contact));

    }
}

