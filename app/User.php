<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'avatar', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute($value)
    {
        // return "https://i.pravatar.cc/100?u=" . $this->email;
        return asset($value ?: 'images/default-avatar.jpg');
    }

    /**
     * Encrypt the password before storing it
     *
     * @var    $value  plain-text password
     * @return null
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $password, //Removed bcrypt
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }

    public function timeline()
    {
        $friends = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            ->withLikes()
            ->latest()
            ->paginate(5);
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    // Laravel <= v6 : Overriding the norm. Would normally return the 'id' of the table. We want it to return the 'name'
    // (Laravel  >= 7 : Only need to update the web.php routes file
    /* public function getRouteKeyName()
        {
            return 'name';
        }
    */

    public function path($append = '')
    {
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }

    public function likes(){
       return $this->hasMany(Like::class);
   }

}
