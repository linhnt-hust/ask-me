<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    protected $table='question_tag';

    protected $fillable = ['question_id', 'tag_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }
}
