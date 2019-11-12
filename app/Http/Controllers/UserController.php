<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Post;
use App\Model\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
	use AuthenticatesUsers;

    public function index()
    {
      $post = Post::with('user', 'comments')->paginate(5);
      return view('home', ['post' => $post]);
    }

    public function indexSuperAdmin()
    {
    	return view('superadmin.login');
    }

    public function storeComment(Request $request)
    {
      $user = User::with('posts')->find($this->idUser());
      $comment = new Comment;
      $comment->comment = $request->comment;
      $comment->user_id = $user->id;
      $comment->post_id = $request->id;
      $comment->save();
      return redirect()->back();
    }

    public function detailPost($id)
    {
      $post = Post::with('comments', 'user')->where('id', $id)->get();
      return view('post-detail', ['post' => $post]);
    }

    public function indexAuthor()
    {
        return view('author.login');
    }

    public function login(Request $request)
    {
        
    	if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
           $data = new User;
           if($data->getSuperAdmin($request->email)) {
                return redirect()->route('dashboardSuperadmin');
           }else if($data->getAuthor($request->email)) {
                return redirect()->route('index');
           }else {
                dd("akun aktifkan dulu oleh superadmin");
           }
    	}else {
    		dd("Username atau password salah");
    	}
    }
}
