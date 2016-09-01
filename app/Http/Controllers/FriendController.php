<?php
namespace App\Http\Controllers;

use App\User;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;

class FriendController extends Controller
{
    use Helpers;

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function addFriendRequest(Request $request)
    {
        $user = $this->auth->user();

        $friend = User::find($request->id);

        $user->addFriend($friend);

        return $this->response->created();
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function approveFriendRequest(Request $request)
    {
        $user = $this->auth->user();

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
     * @return \Dingo\Api\Http\Response
     */
    public function ignoreFriendRequest(Request $request)
    {
        $user = $this->auth->user();

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
}