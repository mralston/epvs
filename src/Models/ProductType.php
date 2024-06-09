<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class ProductType extends Model
{
    use HydratesRelations;

    protected $table = 'epvs_product_types';

    protected $fillable = [
        'name',
    ];
}