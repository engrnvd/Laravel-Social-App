<?php

namespace App\Repositories;

use App\User;
use App\Skill;

class SkillRepository
{
    /**
     * Get all of the Skills for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Skill::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}