<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    public function follower()
    {
        return $this->hasOne(User::class);
    }

    public function followed()
    {
        return $this->hasOne(User::class);
    }
}
