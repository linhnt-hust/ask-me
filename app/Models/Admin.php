<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Admin extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'avatar',
        'description',
    ];

    const FOLDER_IMAGE = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function uploadImage($file, $dir)
    {
        $time = Carbon::now();
        $dataFile = $file;
        $nameFile = $time->timestamp . $dataFile->getClientOriginalName();
        $destinationPath = base_path() . '/public/images/' . $dir;
        $file->move($destinationPath, $nameFile);
        return $nameFile;
    }
}
