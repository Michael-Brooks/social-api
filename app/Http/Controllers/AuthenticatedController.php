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

    public function createComment(Request $request)
    {
        $user = $this->auth->user();

        $this->validate($request, [
            'message'   => 'required'
        ]);

        $status = new StatusUpdate();
        $status->message = $request->message;
        $user->status_updates()->save($status);
    }
}
