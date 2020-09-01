<?php

namespace App\Http\Controllers;

use App\Tweet;

class TweetsController extends Controller
{
    public function index()
    {
        // return current_user()->timeline();

        return view('tweets.index', [
            'tweets' => auth()
                ->user()
                ->timeline(),
        ]);
    }

	public function store()
	{
		$attributes = request()->validate(['body' => 'required|max:255']);

		Tweet::create([
			'user_id' =>auth()->id(),
			'body' => $attributes['body']
			]);

		// Can't do this now!
		// return redirect('/home');
		// But we can do this...
		return redirect()->route('home');
	}
}
