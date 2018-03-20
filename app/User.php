<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'username',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
		'password',
		'remember_token',
		'created_at',
		'updated_at',
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
	public function scopeUsername( $query, $username )
	{
		return $query->where( 'username', $username );
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

	public function friends()
	{
		return $this->belongsToMany( 'App\User', 'friendships', 'user_id', 'friend_id' );
	}

	public function addFriend( User $user )
	{
		$this->friends()->attach( $user->id );
	}

	public function removeFriend( User $user )
	{
		$this->friends()->detach( $user->id );
	}

	// friendship that I started
	function friendsOfMine()
	{
		return $this->belongsToMany( 'App\User', 'friendships', 'user_id', 'friend_id' )
		            ->wherePivot( 'approved', '=', 1 )// to filter only accepted
		            ->withPivot( 'approved' ); // or to fetch accepted value
	}

	// friendship that I was invited to
	function friendOf()
	{
		return $this->belongsToMany( 'App\User', 'friendships', 'friend_id', 'user_id' )
		            ->wherePivot( 'approved', '=', 1 )
		            ->withPivot( 'approved' );
	}

	// accessor allowing you call $user->friends
	public function getFriendsAttribute()
	{
		if ( ! array_key_exists( 'friendships', $this->relations ) ) {
			$this->loadFriends();
		}

		return $this->getRelation( 'friendships' );
	}

	protected function loadFriends()
	{
		if ( ! array_key_exists( 'friendships', $this->relations ) ) {
			$friends = $this->mergeFriends();
			$this->setRelation( 'friendships', $friends );
		}
	}

	protected function mergeFriends()
	{
		return $this->friendsOfMine->merge( $this->friendOf );
	}

	/*public function statusUpdates()
	{
		return $this->hasMany( 'App\StatusUpdate' );
	}*/
}
