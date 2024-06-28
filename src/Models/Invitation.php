<?php

namespace JornBoerema\BzUserManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'email',
        'roles',
    ];
}
