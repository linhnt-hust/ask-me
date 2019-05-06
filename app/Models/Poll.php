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
}
