<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Poll extends Model
{

    protected $table = 'poll_fields';

    protected $fillable = [
        'title',
        'question_id',
        'votes'
    ];

    protected $date = [
        'created_at',
        'updated_at'
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function voteQuestionPoll($data =array())
    {
        $vote = Poll::where('question_id', $data['question_id'])
            ->where('id', $data['poll_id'])
            ->first()->increment('votes');
        PollVoteHistory::create([
            'question_id' => $data['question_id'],
            'poll_id' => $data['poll_id'],
            'user_id' => $data['user_id'],
        ]);
        return $vote;
    }
}
