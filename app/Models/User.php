<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'profile_photo_path', 'private',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function postUrls()
    {
        return $this->hasMany(PostUrl::class);
    }

    public function uploads()
    {
        return $this->hasManyThrough(PostUrl::class, Post::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('user_id', $user->id)->exists();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'receiver_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }


public function requestPending($user)
{
    return FollowRequest::where('sender_id', $user->id)
                        ->where('receiver_id', $this->id)
                        ->exists();
}


    public function activeRequests()
    {
        return $this->hasMany(FollowRequest::class, 'sender_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(FollowRequest::class, 'receiver_id');
    }

    public function requests()
    {
        return $this->hasMany(FollowRequest::class, 'sender_id');
    }
}
