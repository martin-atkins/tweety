<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\store;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        // Uncommenting this returns the raw data and
        // doesn't pass it through the view
        // return $user->timeline();

        return view('profiles.show', [
            'user' => $user,
            // this was like this...
            // 'tweets' => $user
            //     ->tweets()
            //     ->paginate(5),
            // I tried to fix this myself (when it wasn't working) like this
            // 'tweets' => $user
            //     ->timeline()
            // But he fixes it like this...
           'tweets' => $user
               ->tweets()
               ->withLikes()
               ->paginate(5),
        ]);

    }

    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        // dd(request('avatar'));
        $attributes = request()->validate(
            [
                'username' => [
                    'string',
                    'required',
                    'max:255',
                    'alpha_dash',
                    Rule::unique('users')->ignore($user),
                ],
                'name' => [
                    'string',
                    'required',
                    'max:255'
                ],
                'avatar' => ['file'],
                'email' => [
                    'string',
                    'required',
                    'max:255',
                    'email',
                    Rule::unique('users')->ignore($user),
                ],
                'password' => [
                    'string',
                    'required',
                    'min:8',
                    'max:255',
                    'confirmed',
                ]
            ]
        );

        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }

        $user->update($attributes);

        return redirect($user->path());
    }
}
