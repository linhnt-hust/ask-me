<?php

namespace App\Mail;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailToOwner extends Mailable
{
    use Queueable, SerializesModels;

    protected $question;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->question->user->email)
            ->view('mails.sendmail_approve')
            ->subject('Approved Data Report/ Thông báo trạng thái kiểm duyệt')
            ->with([
                'question' => $this->question,
            ]);
    }
}
