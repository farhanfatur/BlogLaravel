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

    public function index(Request $request)
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

    public function detailPost(Request $request, $id)
    {
      if($request->session()->get('post') == null) {
        $request->session()->push('post', $id);

        $updateVisitor = Post::find(intval($id));
        $updateVisitor->viewer = $updateVisitor->viewer + 1;
        $updateVisitor->save();
      }else {
        
        $posts = $request->session()->get('post');
        if(!in_array($id, $posts)) {
          $request->session()->push('post', $id);
          $updateVisitor = Post::find(intval($id));
          $updateVisitor->viewer = $updateVisitor->viewer + 1;
          $updateVisitor->save();
        }
      }

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
          
           if(Auth::user()->position == 'superadmin' && Auth::user()->is_active == '1') {
                return redirect()->route('dashboardSuperadmin');
           }else if(Auth::user()->position == 'author' && Auth::user()->is_active == '1') {
                return redirect()->route('index');
           }else {
                Auth::logout();
                return redirect()->back()->withErrors(['Akun belum aktif silakan hubungi admin']);
           }
    	}else {
        return redirect()->back()->withErrors(['Username atau Password salah']);
    	}
    }
}
