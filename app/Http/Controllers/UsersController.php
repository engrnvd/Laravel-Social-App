<?php

namespace App\Http\Controllers;

use App\Connection;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware("jwt.auth");
    }

    public function index(Request $request)
    {
        return User::all(['id','name','email','role']);
    }

    public function followers(Request $request, User $user)
    {
        if(!$followers = $user->followers or $followers->isEmpty())
            throw new HttpException('404',$user->name." does not have any followers yet.");
        \ChromePhp::log($followers);
        $this->authorize("viewFollowedUsers",$user);
        return $followers;
    }

    public function following(Request $request, User $user)
    {
        if(!$following = $user->following or $following->isEmpty())
            throw new HttpException('404',$user->name." does not follow anyone yet.");
        return $following;
    }

    public function follow(Request $request, User $user)
    {
        $connection = new Connection();
        $connection->follower = $request->user()->id;
        $connection->follows = $user->id;
        $this->authorize("canFollow",$connection);
        $connection->save();
    }

}
