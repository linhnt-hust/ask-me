<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table='blog_category';

    protected $fillable = ['blog_id', 'category_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
