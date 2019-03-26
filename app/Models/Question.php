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
        'user_id',
        'status',
    ];

    protected $date = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    const PENDING = 0;
    const APPROVED = 1;
    const DENIED = 2;

    public static $approveStatus = [
        self::PENDING => 'PENDING',
        self::APPROVED => 'APPROVED',
        self::DENIED => 'DENIED',
    ];

    //categories-question

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getUserQuestion($userId)
    {
        $query = Question::where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate(5);
        return $query;
    }

    public function getQuestionToApprove()
    {
        $query = Question::orderBy('created_at', 'ASC')->get();
        return $query;
    }

    public function getQuestionDetail($id)
    {
        $query = Question::findOrFail($id);
        return $query;
    }

    public function createQuestion($params)
    {
        $params['question_poll'] = $params['question_poll'] ?? 0;
        $params['user_id'] = $params['userId'];
        $data = Question::create($params);
        return $data;
    }
}
