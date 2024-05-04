<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'last_activity_formatted',
        'full_name',
    ];
}