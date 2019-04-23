<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'parent_id',
        'body',
        'commentable_id',
        'commentable_type',
    ];

    protected $date = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id');
    }

    public function getCommentIds($questionId)
    {
        return Comment::where('commentable_id', $questionId)->pluck('id')->toArray();
    }
}
