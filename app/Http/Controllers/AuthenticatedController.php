<?php
namespace App\Http\Controllers;

use App\StatusUpdate;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticatedController extends Controller
{
    use Helpers;

    public function __construct()
    {
        $this->middleware('api.auth');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index (Request $request)
    {
        return $this->auth->user();
    }

    public function createStatusUpdate(Request $request)
    {
        $user = $this->auth->user();

        $this->validate($request, [
            'message'   => 'required'
        ]);

        $status = new StatusUpdate();
        $status->message = $request->message;
        $user->statusUpdates()->save($status);

        return $this->response->created();
    }

    public function editStatusUpdate(Request $request, $id)
    {
        $user = $this->auth->user();

        $comment = $user->statusUpdates->find($id);

        $comment->update(['message' => $request->message]);
    }

    public function deleteStatusUpdate(Request $request, $id)
    {
        $user = $this->auth->user();

        $comment = $user->statusUpdates->find($id);

        $comment->delete();
    }

    public function addFriendRequest(Request $request, $username)
    {
        $user = $this->auth->user();

        $friend = $user::username($username);

        $user->addFriend($friend);

        return $this->response->created();
    }

    public function approveFriendRequest(Request $request, $username)
    {
        $user = $this->auth->user();

        $friendFromRequest = $username::username($username);

        $friendFromRequest->friends()->updateExistingPivot(
            $user->id,
            [
                'approved' => 1
            ]
        );
    }

    public function ignoreFriendRequest(Request $request, $username)
    {
        $user = $this->auth->user();

        $friendFromRequest = $username::username($username);

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
    }
}
