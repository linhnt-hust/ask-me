<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollVoteHistory extends Model
{

    protected $table = 'poll_vote_history';

    protected $fillable = [
        'poll_id',
        'question_id',
        'user_id'
    ];

    protected $date = [
        'created_at',
        'updated_at'
    ];
}
