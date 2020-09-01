<?php

namespace App\Http\Controllers;

use App\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
    	// Have the auth'd user follow the given user
    	auth()
    		->user()
    		->toggleFollow($user);

		return back();	
    }
}
