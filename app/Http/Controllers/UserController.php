<?php
namespace App\Http\Controllers;

use Auth;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($username)
    {
        return User::username($username)->get();
    }

    public function friends($username)
    {
        return User::username($username)->first()->friends;
    }

    public function statusUpdates($username)
    {
        return User::username($username)->first()->statusUpdates;
    }
}
