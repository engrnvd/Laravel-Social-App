<?php

namespace App\Policies;

use App\Setting;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingsPolicy
{
    use HandlesAuthorization;

    public function owns(User $user, Setting $setting)
    {
        \ChromePhp::log($user->attributesToArray());
        \ChromePhp::log($setting->attributesToArray());
        return $user->id == $setting->user_id;
    }
}
