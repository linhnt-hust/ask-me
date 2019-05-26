<?php

namespace App\Listeners;

use App\Events\SendMailDeleteQuestion;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\SendMailDeleteQuestionByAdmin;

class SendMailDeleteQuestionAdmin
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
     * @param  SendMailDeleteQuestion  $event
     * @return void
     */
    public function handle(SendMailDeleteQuestion $event)
    {
        Mail::send(new SendMailDeleteQuestionByAdmin($event->question));
    }
}
