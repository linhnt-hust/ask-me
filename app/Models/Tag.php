<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tags';

    protected $fillable = [
        'name_tag',
    ];

    protected $date = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function question()
    {
        return $this->belongsToMany('App\Models\Question');
    }

    public function getTagList()
    {
        return Tag::orderBy('created_at', 'ASC')->paginate(10);
    }

    public function searchTag($input)
    {
        return Tag::where('name_tag', 'LIKE', '%' . $input['search'] . '%')->paginate(10);
    }

    public function getNewTag()
    {
        return Tag::orderBy('created_at','DESC')->paginate(10);
    }

    public function getOldestTag()
    {
        return Tag::orderBy('created_at','ASC')->paginate(10);
    }

    public function getMostQuestionsTag()
    {
        return Tag::withCount("question as questions")->orderBy('questions', 'DESC')->paginate(10);
    }
}
