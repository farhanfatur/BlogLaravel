<?php

namespace App\Http\Controllers\author;

use App\Model\Comment;
use App\Model\Post;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	return view('author.home');
    }
}
