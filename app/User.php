<?php

namespace App;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements Authenticatable, JWTSubject
{
    use \Illuminate\Auth\Authenticatable;

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'password', 'pivot',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

	/**
     * Get the identifier that will be stored in the subject claim of the JWT
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

	/**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsername($query, $username)
    {
        return $query->where('username', $username);
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

	/**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = app('hash')->make($value);
    }

	public function friends()
	{
		return $this->belongsToMany('App\User', 'friendship', 'user_id', 'friend_id');
	}

	public function addFriend(User $user)
	{
		$this->friends()->attach($user->id);
	}

	public function removeFriend(User $user)
	{
		$this->friends()->detach($user->id);
	}

	// friendship that I started
	function friendsOfMine()
	{
	  return $this->belongsToMany('App\User', 'friendship', 'user_id', 'friend_id')
	     ->wherePivot('approved', '=', 1) // to filter only accepted
	     ->withPivot('approved'); // or to fetch accepted value
	}

	// friendship that I was invited to
	function friendOf()
	{
	  return $this->belongsToMany('App\User', 'friendship', 'friend_id', 'user_id')
	     ->wherePivot('approved', '=', 1)
	     ->withPivot('approved');
	}

	// accessor allowing you call $user->friends
	public function getFriendsAttribute()
	{
	    if ( ! array_key_exists('friendship', $this->relations)) $this->loadFriends();

	    return $this->getRelation('friendship');
	}

	protected function loadFriends()
	{
	    if ( ! array_key_exists('friendship', $this->relations))
	    {
	        $friends = $this->mergeFriends();

	        $this->setRelation('friendship', $friends);
	    }
	}

	protected function mergeFriends()
	{
	    return $this->friendsOfMine->merge($this->friendOf);
	}

	public function status_updates()
	{
		return $this->hasMany('App\StatusUpdate');
	}
}
