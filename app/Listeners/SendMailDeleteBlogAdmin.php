<?php

namespace App\Listeners;

use App\Events\SendMailDeleteBlog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\SendMailDeleteBlogByAdmin;

class SendMailDeleteBlogAdmin
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
     * @param  SendMailDeleteBlog  $event
     * @return void
     */
    public function handle(SendMailDeleteBlog $event)
    {
        Mail::send(new SendMailDeleteBlogByAdmin($event->blog));
    }
}
