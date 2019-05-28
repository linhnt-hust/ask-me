<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Events\SendMailCloseOpenQuestion;
use App\Mail\SendMailCloseStatusToOwner;

class SendMailOpenCloseAnnounce
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
     * @param  object  $event
     * @return void
     */
    public function handle(SendMailCloseOpenQuestion $event)
    {
        Mail::send(new SendMailCloseStatusToOwner($event->question, $event->followUser));
    }
}
