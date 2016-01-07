<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewSkills(User $currentUser, User $accessedUser)
    {
        // a user can obviously see their own skills
        if($currentUser->id == $accessedUser->id)
            return true;

        $settings = $accessedUser->settings;

        if(!$settings)
            return true;

        $config = $settings->who_can_see_my_skills;

        if($config == 'Only me')
            throw new HttpException('403',$accessedUser->name." does not allow any one to see his/her skills.");

        if(!$currentUser->isFollowing($accessedUser) and $config == 'Only those who are following me')
            throw new HttpException('403',$accessedUser->name." only allows his/her followers to see his/her skills.");

        if(!$accessedUser->isFollowing($currentUser) and $config == 'Only those I am following')
            throw new HttpException('403',$accessedUser->name." only allows people followed by him/her to see his/her skills.");

        return true;
    }

    public function viewFollowedUsers(User $currentUser, User $accessedUser)
    {
        // a user can obviously see their own followed people
        if($currentUser->id == $accessedUser->id)
            return true;

        $settings = $accessedUser->settings;

        if(!$settings)
            return true;

        $config = $settings->who_can_see_who_i_am_following;

        if($config == 'Only me')
            throw new HttpException('403',$accessedUser->name." does not allow any one to see his/her followed people.");

        if(!$currentUser->isFollowing($accessedUser) and $config == 'Only those who are following me')
            throw new HttpException('403',$accessedUser->name." only allows his/her followers to see his/her followed people.");

        if(!$accessedUser->isFollowing($currentUser) and $config == 'Only those I am following')
            throw new HttpException('403',$accessedUser->name." only allows people followed by him/her to see his/her followed people.");

        return true;
    }
}
