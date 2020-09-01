<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Likable
{
    public function scopeWithLikes(Builder $query)
    {
        // SELECT * FROM tweets
        //   LEFT JOIN (
        //     SELECT tweet_id, SUM(liked) likes, SUM(!liked) dislikes FROM likes GROUP BY tweet_id
        //   ) AS likes
        //   ON likes.tweet_id = tweets.id;

        // leftJoinSub($query, $as, $first)
        $query->leftJoinSub(
            'SELECT tweet_id, SUM(liked) likes, SUM(!liked) dislikes FROM likes GROUP BY tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', false)
            ->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user)
    {
        // Simple way, but n+1 problem
        // $this->likes()->where('user_id', $user->id)->exists();

        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate(
            [
                'user_id' => $user ? $user->id : auth()->id(),
            ],
            [
                'liked' => $liked,
            ]
        );
    }
}
