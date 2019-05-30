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

    public function searchTags($input)
    {
        return Tag::where('name_tag', 'LIKE', '%' . $input['search'] . '%')->get();
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

    public function recommendTagByCategory($categoryId)
    {
        $questions = Question::where('category_id', $categoryId)->get();
        $allTags = [];
        foreach ($questions as $question)
        {
            foreach ($question->tag as $tag)
            {
                if(in_array($tag->id, $allTags)){
                    $key = array_search($tag->id, $allTags);
                    unset($allTags[$key]);
                    array_unshift($allTags, $tag->id);
                } else{
                    $allTags[] = $tag->id;
                }
            }
        }
        $recommendTags = array_slice($allTags, 0, 3);

        return $recommendTags;
    }
}
