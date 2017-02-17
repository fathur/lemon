<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow($userId)
    {
        $user = \Auth::user();

        $user->followings()->attach($userId);
    }

    public function unfollow($userId)
    {
        $user = \Auth::user();

        $user->followings()->detach($userId);
    }
}
