<?php

namespace App\Http\Controllers\author;

use App\Model\Comment;
use App\Model\Post;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{

    public function register(Request $request)
    {
    	$this->validate($request, [
    		"name" => "required",
    		"email" => "required|unique:users",
    		"password" => "required|min:8|confirmed",
    	]);

    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
    	$user->position = 'author';
    	$user->is_active = '1';
    	$user->remember_token = str_random(24);
    	$user->save();

    	return redirect()->route('indexAuthor');
    }

    public function post()
    {
        $comment = array();
        $sumComment = array();

        $post = User::with('posts')->find($this->idUser());
        foreach($post->posts as $data) {
            $comment[] = Post::with('comments')->find($data->id);
        }

        foreach($comment as $val) {
            $sumComment[] = count($val->comments);
        }
        return view('author.post', compact('post', 'sumComment'));
    }

    public function commentbypost($id)
    {
        $post = Post::with('comments','user')->find($id);
        return view('author.post-comment', ['posts' => $post]);
    }

    public function store(Request $request)
    {
        $request->user()->posts()->create([
            "title" => $request->title,
            'text' => $request->content,
            'viewer' => 0,
        ]);
        
        return redirect()->route('indexPost');
    }

    public function find($id)
    {
        $post = Post::find($id);
        return view('author.post-detail', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('author.post-edit', ['post' => $post]);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('indexPost');
    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->text = $request->content;
        $post->save();

        return redirect()->route('indexPost');
    }
}
