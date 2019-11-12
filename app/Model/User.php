<?php

namespace App\Model;

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
    protected $fillable = [
        'name', 'email', 'password', 'position', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getSuperAdmin($email)
    {
        $result = $this->where('position', 'superadmin')->where('is_active', 1)->where('email', $email)->get();
        return count($result) != 0 ? true : false;
        
    }

    public function getAuthor($email)
    {
        $result = $this->where('position', 'author')->where('is_active', 1)->where('email', $email)->get();
        return count($result) != 0 ? true : false;
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function posts()
    {
        return $this->hasMany('App\Model\Post');
    }
}
