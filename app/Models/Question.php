<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
        'title',
        'question_poll',
        'details',
        'user_id'
    ];

    protected $date = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function createQuestion($params)
    {
        $params['question_poll'] = $params['question_poll'] ?? 0;
        $data = Question::create($params);
        return $data;
    }
}
