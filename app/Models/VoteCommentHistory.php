<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteCommentHistory extends Model
{
    protected $table = 'user_vote_history';

    protected $fillable = [
        'comment_id',
        'user_id',
        'up',
        'down',
    ];

    protected $date = [
        'created_at',
        'updated_at'
    ];

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }
}

