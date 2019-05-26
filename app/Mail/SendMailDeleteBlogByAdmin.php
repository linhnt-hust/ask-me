<?php

namespace App\Mail;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailDeleteBlogByAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $blog;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->blog->user->email)
            ->view('mails.sendmail_delete_blog')
            ->subject('Delete Blog Announce/ Thông báo xoá bài đăng')
            ->with([
                'blog' => $this->blog,
            ]);
    }
}
