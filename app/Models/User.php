<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'website',
        'country',
        'avatar',
        'description',
        'facebook_account',
        'twitter_account',
        'github_account',
        'googleplus_account',    
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function updateUser($data, $id)
    {
        $user = User::withTrashed()->find($id);
        if (isset($data['password']) && $data['password'] != '') {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        if($data->hasFile('avatar')){
            $file1= $user->avatar;
            File::delete('avatars/'.$file1);
            $file = $data->avatar;
            $file->move('avatar',$file->getClientOriginalName());
            $user->avatar = $file->getClientOriginalName();
            $user->save();
        }

        $input = [ 
            'name' => $data['name'],
            'address' => $data['address'],
            'password' => $data['password'],
            'email' => $data['email'],
            'website' => $data['website'],
            'country' => $data['country'],
            'description' => $data['description'],
            'facebook_account' => $data['facebook_account'],
            'twitter_account' => $data['twitter_account'],
            'github_account' => $data['github_account'],
            'googleplus_account' => $data['googleplus_account'],
        ];
        return $user->update($input);
    }
}
