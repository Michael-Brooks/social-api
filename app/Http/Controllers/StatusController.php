<?php
namespace App\Http\Controllers;

use App\User;

class StatusController extends Controller
{
    public function statusUpdates($username)
    {
        return User::username($username)->first()->statusUpdates;
    }
}
