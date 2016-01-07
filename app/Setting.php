<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public static $options = [
        'Everyone',
        'Only me',
        'Only those who are following me',
        'Only those I am following'
    ];

}
