<?php
namespace App\Http\Controllers;

use App\User;
use App\StatusUpdate;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;

class StatusController extends Controller
{
    use Helpers;

    /**
     * @param $username
     * @return mixed
     */
    public function statusUpdates($username)
    {
        return User::username($username)->first()->statusUpdates;
    }

    /**
     * @param Request $request
     * @return mixed
     */
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

    /**
     * @param Request $request
     * @return mixed
     */
    public function editStatusUpdate(Request $request)
    {
        $user = $this->auth->user();

        $comment = $user->statusUpdates->find($request->id);

        $comment->update(['message' => $request->message]);

        return $this->response->accepted();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function deleteStatusUpdate(Request $request)
    {
        $user = $this->auth->user();

        $comment = $user->statusUpdates->find($request->id);

        $comment->delete();

        return $this->response->accepted();
    }
}
