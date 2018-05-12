<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_active', 'role_id', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }
    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function isAdmin()
    {
        if($this->role->name == 'administrator' && $this->is_active == 1)
        {
            return true;
        }
        return false;
    }

    public static function boot ()
    {
        parent::boot();

        self::deleting(function (User $user) {

            foreach ($user->posts as $post)
            {
                if($post->photo){ unlink(public_path().$post->photo->file);}
                $post->photo->delete();
                $post->delete();
            }

        });
    }

}
