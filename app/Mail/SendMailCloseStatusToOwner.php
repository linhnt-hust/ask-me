<?php

namespace App\Mail;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailCloseStatusToOwner extends Mailable
{
    use Queueable, SerializesModels;

    protected $question;
    protected $followUser;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Question $question, $followUser)
    {
        $this->question = $question;
        $this->followUser = $followUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->followUser->email)
            ->view('mails.sendmail_close_open')
            ->subject('Follow Question Announce/ Thông báo câu hỏi mà bạn đã follow')
            ->with([
                'question' => $this->question,
                'followUser' => $this->followUser,
            ]);
    }
}
