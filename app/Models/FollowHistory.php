<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowHistory extends Model
{
    protected $table = 'follow_history';

    protected $fillable = [
        'question_id',
        'user_id',
    ];

    protected $date = [
        'created_at',
        'updated_at'
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
