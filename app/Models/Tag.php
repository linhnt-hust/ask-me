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
}
