<?php

namespace App\Http\Controllers\superadmin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function updateActive($id, $idActive)
    {
    	$user = User::find($id);
    	if($idActive == 1) {
    		$user->is_active = '0';
    		$user->save();
    	}else {
    		$user->is_active = '1';
    		$user->save();
    	}
    	return redirect()->route('viewAuthor');
    }

    public function saveAuthor(Request $request)
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
    	$user->is_active = '0';
    	$user->remember_token = str_random(24);
    	$user->save();

    	return redirect()->route('viewAuthor');
    }
}
