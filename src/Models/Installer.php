<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class Installer extends Model
{
    use HydratesRelations;

    protected $table = 'epvs_installers';

    protected $fillable = [
        'name',
    ];
}