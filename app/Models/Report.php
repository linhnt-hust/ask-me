<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report_history';

    protected $fillable = [
        'question_id',
        'user_id',
        'type',
        'message',
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
