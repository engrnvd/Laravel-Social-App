<?php

namespace App\Http\Controllers;

use App\Connection;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return $user->followers;
    }

    public function following(Request $request, User $user)
    {
        return $user->following;
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
