<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function categoryQuestion()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function getAllCategories()
    {
        return Category::orderBy('name_category')->get();
    }
}
