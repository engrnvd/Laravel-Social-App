<?php

namespace App\Policies;

use App\Skill;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkillPolicy
{
    use HandlesAuthorization;

    public function owns(User $user, Skill $skill)
    {
        return $user->id == $skill->user_id;
    }
}
