<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo('App\Model\User');
    }

   	public function comments()
   	{
   		return $this->hasMany('App\Model\Comment');
   	}
}
