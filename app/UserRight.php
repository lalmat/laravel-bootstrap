<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRight extends Model
{
    function user() {
        return $this->belongsTo('\App\User');
    }
}
