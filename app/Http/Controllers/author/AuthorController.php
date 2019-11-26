<?php

namespace App\Http\Controllers\author;

use App\Model\Comment;
use App\Model\Post;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $image = str_slug($request->title).".png";
        $request->user()->posts()->create([
            "title" => $request->title,
            'title_slug' => strtolower(str_slug($request->title)),
            'text' => $request->content,
            'image' => $image,
            'viewer' => 0,
        ]);

        Storage::putFileAs('public/post/image', $request->file('image'), $image);
        Image::make(storage_path('app/public/post/image/'.$image))->resize(320, 240)->save(storage_path('app/public/post/thumbnail/thumbnail_'.$image));

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
       
       $image = "edit_".strtolower(str_slug($request->title).".png");

        $post = Post::find($request->id);
        if($request->photos) {
            $pathImage = storage_path('app\\public\\post\\image\\'.$post->image);
            $pathThumbnail = storage_path('app\\public\\post\\thumbnail\\thumbnail_'.$post->image);
            if(File::exists($pathImage) && File::exists($pathThumbnail)) {
                File::delete($pathThumbnail);
                File::delete($pathImage);
            }

            $post->title = $request->title;
            $post->title_slug = str_slug($request->title);
            $post->text = $request->content;
            $post->image = $image;
            $post->save();
            Storage::putFileAs('public/post/image', $request->file('photos'), $image);
            Image::make(storage_path('app/public/post/image/'.$image))->resize(320, 240)->save(storage_path('app/public/post/thumbnail/thumbnail_'.$image));    
        }else {
            $post->title = $request->title;
            $post->title_slug = str_slug($request->title);
            $post->text = $request->content;
            $post->save();
        }
        

        return redirect()->route('indexPost');
    }
}
