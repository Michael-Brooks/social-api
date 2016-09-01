<?php
namespace App\Http\Controllers;

use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\User;

class AuthenticatedController extends Controller
{
    use Helpers;

    /**
     * @param Request $request
     * @return mixed
     */
    public function index (Request $request)
    {
        return $this->auth->user();
    }
}
