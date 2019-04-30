<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
        'title',
        'question_poll',
        'details',
        'user_id',
        'category_id',
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


    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->whereNull('parent_id');
    }

    public function getUserQuestion($userId)
    {
        $query = Question::where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate(5);
        return $query;
    }

    public function getQuestionToApprove()
    {
        $query = Question::orderBy('created_at', 'DESC')->get();
        return $query;
    }

    public function getQuestionDetail($id)
    {
        $query = Question::findOrFail($id);
        return $query;
    }

    public function createQuestion($params)
    {
        $input['question_poll'] = $params['question_poll'] ?? 0;
        $input['user_id'] = $params['userId'];
        $input['category_id'] = $params['category'];
        $input['title'] = $params['title'];
        $input['details'] = $params['details'];
        $data = Question::create($input);
        return $data;
    }

    public function verifyQuestion($request)
    {
        $verifiedAt = Carbon::now();
        if ($request['submitButton'] == 'approve') {
            $approvedActual = 1;
        } else if ( $request['submitButton'] == 'deny') {
            $approvedActual = 2;
        }

        $questionId = $request['question_id'];
        $verifiedAuthor = $request['verify_author'];
        $note = $request['note'] ?? null;

        $builder = Question::where('id', $questionId)
                        ->update([
                            'verified_at' => $verifiedAt,
                            'approve_status' => $approvedActual,
                            'verify_author' => $verifiedAuthor,
                            'note' => $note,
                        ]);
        return $builder;
    }

    public function getRecentQuestions()
    {
        return Question::where('approve_status', '=', 1 )->orderBy('updated_at', 'DESC')->get();
    }
}
