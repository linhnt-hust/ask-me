<?php

namespace App\Listeners;

use App\Events\SendMailApprove;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\SendMailToOwner;

class SendMailApproveQuestion
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
     * @param  SendMailApprove  $event
     * @return void
     */
    public function handle(SendMailApprove $event)
    {
        Mail::send(new SendMailToOwner($event->question));
    }
}
