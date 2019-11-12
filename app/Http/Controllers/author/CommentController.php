<?php

namespace App\Http\Controllers\author;

use App\Model\User;
use App\Model\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
    	$data = User::with('comments', 'posts')->find($this->idUser());
    	return view('author.comment', ['datas' => $data]);
    }

    public function edit(Request $request, $id)
    {
    	$comment = Comment::with('post')->find($id);
    	return view('author.comment-edit', ['comments' => $comment]);
    }

    public function delete($id)
    {
    	$comment = Comment::find($id);
    	$comment->delete();

    	return redirect()->route('indexComment');
    }

    public function update(Request $request)
    {
    	$comment = Comment::find($request->id);
    	$comment->comment = $request->comment;
    	$comment->save();

    	return redirect()->route('indexComment');
    }
}
