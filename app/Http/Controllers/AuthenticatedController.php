<?php
namespace App\Http\Controllers;

use App\StatusUpdate;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\User;

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

    public function editStatusUpdate(Request $request)
    {
        $user = $this->auth->user();

        $comment = $user->statusUpdates->find($request->id);

        $comment->update(['message' => $request->message]);

        return $this->response->accepted();
    }

    public function deleteStatusUpdate(Request $request)
    {
        $user = $this->auth->user();

        $comment = $user->statusUpdates->find($request->id);

        $comment->delete();

        return $this->response->accepted();
    }

    public function addFriendRequest(Request $request)
    {
        $user = $this->auth->user();

        $friend = User::find($request->id);

        $user->addFriend($friend);

        return $this->response->created();
    }

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
