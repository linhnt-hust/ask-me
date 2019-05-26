<?php

namespace App\Listeners;

use App\Events\SendMailApproveBlog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\SendMailToBlogOwner;

class SendMailApproveBlogAdmin
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
     * @param  SendMailApproveBlog  $event
     * @return void
     */
    public function handle(SendMailApproveBlog $event)
    {
        Mail::send(new SendMailToBlogOwner($event->blog));
    }
}
