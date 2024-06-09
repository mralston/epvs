<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class PaymentMethod extends Model
{
    use HydratesRelations;

    protected $table = 'epvs_payment_methods';

    protected $fillable = [
        'name',
    ];
}