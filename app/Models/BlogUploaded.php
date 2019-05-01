<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogUploaded extends Model
{
    protected $table = 'blog_uploaded';

    protected $fillable = ['blog_id', 'filename'];

    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }
}
