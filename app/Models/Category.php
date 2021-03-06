<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name_category',
    ];

    protected $date = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function blog()
    {
        return $this->belongsToMany('App\Models\Blog');
    }

    public function categoryQuestion()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function getAllCategories()
    {
        return Category::orderBy('name_category')->paginate(10);
    }

    public function getAllCategory()
    {
        return Category::orderBy('name_category')->get();
    }

    public function getRecentCategories()
    {
        return Category::orderBy('created_at', 'DESC')->paginate(10);
    }

    public function getAllCategoriesQuestion()
    {
        return Category::orderBy('name_category')->paginate(6);
    }

    public function searchCategory($input)
    {
        return Category::where('name_category', 'LIKE', '%' . $input['search'] . '%')->paginate(6);
    }

    public function searchCategories($input)
    {
        return Category::where('name_category', 'LIKE', '%' . $input['search'] . '%')->get();
    }

    public function countQuestionByCategory($categoryId)
    {
        return Question::where('category_id', $categoryId)->get()->count();
    }

    public function getNewCategory()
    {
        return Category::orderBy('created_at','DESC')->paginate(10);
    }

    public function getOldCategory()
    {
        return Category::orderBy('created_at','ASC')->paginate(10);
    }

    public function getMostQuestionCategory()
    {
        return Category::withCount("categoryQuestion as questions")->orderBy('questions', 'DESC')->paginate(10);
    }

    public function getMostBlogCategory()
    {
        return Category::withCount("blog as blogs")->orderBy('blogs', 'DESC')->paginate(10);
    }
}
