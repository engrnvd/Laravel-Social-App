<?php

namespace App\Policies;

use App\Connection;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ConnectionPolicy
{
    use HandlesAuthorization;

    public function canFollow(User $user, Connection $connection)
    {
        if($user->id == $connection->follows)
            throw new HttpException('403',"You can not follow yourself");

        $alreadyFollowing = Connection::where("follower",$user->id)->where("follows",$connection->follows)->first();
        \ChromePhp::log($alreadyFollowing);
        if($alreadyFollowing)
            throw new HttpException('403',"You are already following this user.");
        return true;
    }
}
