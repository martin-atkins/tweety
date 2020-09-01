<?php

namespace App;

trait Followable
{
    // Adding a comment, only to push something to the GitHub repo.

    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        /* this is cluggy...
        if ($this->following($user)) {
            return $this->unfollow($user);
        }
        return $this->follow($user);
        */

        // This is cleaner and does the same...
        $this->follows()->toggle($user);
    }

    public function following(User $user)
    {
        return $this->follows()
            ->where('following_user_id', $user->id)
            ->exists();
    }

    public function follows()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'following_user_id'
        );
    }
}
