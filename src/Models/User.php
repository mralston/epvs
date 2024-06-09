<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class User extends Model
{
    use HydratesRelations;

    protected $table = 'epvs_users';

    protected $fillable = [
        'first_name',
        'last_name',
        'last_activity_formatted',
        'full_name',
    ];
}