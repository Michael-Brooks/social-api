<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function addFriendRequest(Request $request)
	{
		$user = User::find(Auth::id());
		$friend = User::find($request->id);
		$user->addFriend($friend);
		return $this->response->created();
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function approveFriendRequest(Request $request)
	{
		$user = User::find(Auth::id());
		$friendFromRequest = User::find($request->id);
		$friendFromRequest->friends()->updateExistingPivot(
			$user->id,
			[
				'approved' => 1
			]
		);
		return $this->response->created();
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function ignoreFriendRequest(Request $request)
	{
		$user = User::find(Auth::id());
		$friendFromRequest = User::find($request->id);
		/**
		 * Reason for setting this to 2 is because we need to flag it so it
		 * doesn't show in the notifications again
		 */
		$friendFromRequest->friends()->updateExistingPivot(
			$user->id,
			[
				'approved' => 2
			]
		);
		return $this->response->created();
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function removeFriendRequest(Request $request)
	{
		$user = User::find(Auth::id());
		$friend = User::find($request->id);
		$user->removeFriend($friend);
		return $this->response->accepted();
	}
}
