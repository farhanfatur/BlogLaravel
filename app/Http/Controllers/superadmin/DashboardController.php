<?php

namespace App\Http\Controllers\superadmin;

use App\Model\User;
use App\Model\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	return view('superadmin.home');
    }

    public function authorIndex()
    {
    	$user = User::with('posts')->where('position', 'author')->paginate(5);
    	return view('superadmin.author', ["user" => $user]);
    }

    public function postIndex()
    {
    	$post = Post::with('user')->paginate(5);
    	return view('superadmin.post', ['post' => $post]);
    }

    public function postDetail($id)
    {
    	$post = Post::find($id);
    	return view('superadmin.post-detail', ['post' => $post]);
    }
}
