<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class ValidationStatus extends Model
{
    use HydratesRelations;

    protected $table = 'epvs_validation_statuses';

    protected $fillable = [
        'name',
    ];
}