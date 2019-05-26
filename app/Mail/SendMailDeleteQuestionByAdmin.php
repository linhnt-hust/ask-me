<?php

namespace App\Mail;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailDeleteQuestionByAdmin extends Mailable
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
            ->view('mails.sendmail_delete_question')
            ->subject('Delete Question Announce/ Thông báo xoá câu hỏi')
            ->with([
                'question' => $this->question,
            ]);
    }
}
