<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all of the tasks for the user.
     */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,"connections",'follows','follower');
    }

    public function following()
    {
        return $this->belongsToMany(User::class,"connections",'follower','follows');
    }

    public function settings()
    {
        return $this->hasOne(Setting::class);
    }

    public function isFollowing($user)
    {
       return $this->following()->find($user->id);
    }

}
